<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;
use App\Services\OneSignalService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendBatchNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;
    protected $userIds;
    protected $authUserId;

    /**
     * Create a new job instance.
     *
     * @param Notification $notification
     * @param array $userIds - Array of user IDs (max 2000 for OneSignal)
     * @param int $authUserId
     */
    public function __construct($notification, array $userIds, $authUserId)
    {
        $this->notification = $notification;
        $this->userIds = $userIds;
        $this->authUserId = $authUserId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (empty($this->userIds)) {
            Log::warning("SendBatchNotificationJob called with empty user IDs array");
            return;
        }

        // 1. Fetch all device details for these users in ONE query
        $devices = DB::table('user_device_details')
            ->whereIn('userId', $this->userIds)
            ->select('userId', 'subscription_id', 'subscription_id_web')
            ->get();

        if ($devices->isEmpty()) {
            Log::warning("No device details found for batch of " . count($this->userIds) . " users");
            return;
        }

        // 2. Collect all valid subscription IDs
        $targetIds = [];
        $userIdMapping = []; // Track which subscription_id belongs to which user

        foreach ($devices as $device) {
            if (!empty($device->subscription_id)) {
                $targetIds[] = $device->subscription_id;
                $userIdMapping[$device->subscription_id] = $device->userId;
            }
            if (!empty($device->subscription_id_web)) {
                $targetIds[] = $device->subscription_id_web;
                $userIdMapping[$device->subscription_id_web] = $device->userId;
            }
        }

        // If no valid subscription IDs, skip
        if (empty($targetIds)) {
            Log::info("Batch has device records but no valid subscription IDs for " . count($this->userIds) . " users");
            return;
        }

        // 3. Prepare notification data
        $notificationData = [
            'title' => $this->notification->title,
            'body' => [
                'description' => $this->notification->description,
                'notificationType' => 15
            ],
        ];

        try {
            // 4. Send ONE OneSignal API call for entire batch (up to 2000 devices)
            $oneSignalService = new OneSignalService();
            $response = $oneSignalService->sendNotification(array_values($targetIds), $notificationData);

            // Decode response
            $responseBody = is_string($response) ? json_decode($response, true) : (array)$response;

            // Log::info("OneSignal batch response for " . count($targetIds) . " devices", [
            //     'user_count' => count($this->userIds),
            //     'device_count' => count($targetIds),
            //     'response' => $responseBody
            // ]);

            // 5. Handle invalid player IDs (optional cleanup)
            if (isset($responseBody['errors']['invalid_player_ids'])) {
                $invalidIds = $responseBody['errors']['invalid_player_ids'];
                // Log::warning("Found " . count($invalidIds) . " invalid OneSignal IDs in batch", ['ids' => $invalidIds]);

                // Optional: Clean up invalid IDs from database
                // DB::table('user_device_details')
                //     ->whereIn('subscription_id', $invalidIds)
                //     ->orWhereIn('subscription_id_web', $invalidIds)
                //     ->update(['subscription_id' => null, 'subscription_id_web' => null]);
            }

            // 6. Bulk insert notification history for ALL users in this batch
            $notificationRecords = [];
            $now = now();

            foreach ($this->userIds as $userId) {
                $notificationRecords[] = [
                    'userId' => $userId,
                    'title' => $this->notification->title,
                    'description' => $this->notification->description,
                    'createdBy' => $this->authUserId,
                    'modifiedBy' => $this->authUserId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            // Single bulk insert for entire batch
            if (!empty($notificationRecords)) {
                DB::table('user_notifications')->insert($notificationRecords);
                Log::info("Inserted " . count($notificationRecords) . " notification history records");
            }

        } catch (\Exception $e) {
            Log::error("OneSignal batch send error: " . $e->getMessage(), [
                'user_count' => count($this->userIds),
                'device_count' => count($targetIds)
            ]);
        }
    }
}
