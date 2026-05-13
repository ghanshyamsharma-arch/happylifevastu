<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendBatchNotificationJob;

class ProcessBulkNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reqData;
    protected $authUserId;
    protected $batchSize = 2000; // OneSignal supports up to 2000 player IDs per call

    // We pass the request data array, not the Request object itself
    public function __construct($reqData, $authUserId)
    {
        $this->reqData = $reqData;
        $this->authUserId = $authUserId;
    }

    public function handle()
    {
        $notification = Notification::find($this->reqData['notification_id']);
        if (!$notification) return;

        $userIds = $this->reqData['userIds'] ?? [];
        $role = $this->reqData['role'] ?? null;

        // CASE 1: Specific Users
        if (!empty($userIds) && $userIds !== ['all']) {
            $this->dispatchBatchJobs($notification, $userIds);
        } 
        // CASE 2: Roles (User/Astrologer)
        elseif ($role && in_array($role, ['User', 'Astrologer'])) {
            $roleId = ($role == 'User') ? 3 : 2;
            
            // Collect user IDs and dispatch in batches
            DB::table('user_device_details')
                ->join('user_roles', 'user_roles.userId', '=', 'user_device_details.userId')
                ->where('user_roles.roleId', '=', $roleId)
                ->where('isActive', 1)
                ->where('isDelete', 0)
                ->select('user_device_details.userId')
                ->orderBy('user_device_details.userId') // Required for chunk()
                ->chunk($this->batchSize, function ($users) use ($notification) {
                    $userIds = $users->pluck('userId')->toArray();
                    SendBatchNotificationJob::dispatch($notification, $userIds, $this->authUserId);
                });
        }
        // CASE 3: Never Recharged
        elseif ($role == 'User Never Recharged') {
            DB::table('user_device_details')
                ->join('user_roles', 'user_roles.userId', '=', 'user_device_details.userId')
                ->where('user_roles.roleId', '=', 3)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('user_wallets')
                        ->whereRaw('user_device_details.userId = user_wallets.userId');
                })
                ->select('user_device_details.userId')
                ->orderBy('user_device_details.userId') // Required for chunk()
                ->chunk($this->batchSize, function ($users) use ($notification) {
                    $userIds = $users->pluck('userId')->toArray();
                    SendBatchNotificationJob::dispatch($notification, $userIds, $this->authUserId);
                });
        }
        // CASE 4: Not Used Free Chat/Call
        elseif ($role == 'User Not Used Free Chat/Call') {
            DB::table('user_device_details')
                ->join('user_roles', 'user_roles.userId', '=', 'user_device_details.userId')
                ->where('user_roles.roleId', '=', 3)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('chatrequest')
                        ->whereRaw('user_device_details.userId = chatrequest.userId')
                        ->orWhereExists(function ($subquery) {
                            $subquery->select(DB::raw(1))
                                ->from('callrequest')
                                ->whereRaw('user_device_details.userId = callrequest.userId');
                        });
                })
                ->select('user_device_details.userId')
                ->orderBy('user_device_details.userId') // Required for chunk()
                ->chunk($this->batchSize, function ($users) use ($notification) {
                    $userIds = $users->pluck('userId')->toArray();
                    SendBatchNotificationJob::dispatch($notification, $userIds, $this->authUserId);
                });
        }
        // CASE 5: All Users
        else {
            DB::table('user_device_details')
                ->select('userId')
                ->orderBy('userId') // Required for chunk()
                ->chunk($this->batchSize, function ($users) use ($notification) {
                    $userIds = $users->pluck('userId')->toArray();
                    SendBatchNotificationJob::dispatch($notification, $userIds, $this->authUserId);
                });
        }
    }

    /**
     * Helper method to dispatch batch jobs for an array of user IDs
     */
    protected function dispatchBatchJobs($notification, array $userIds)
    {
        // Split into batches of 2000
        $batches = array_chunk($userIds, $this->batchSize);
        
        foreach ($batches as $batch) {
            SendBatchNotificationJob::dispatch($notification, $batch, $this->authUserId);
        }
    }
}
