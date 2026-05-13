<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\PujariSlot;
use App\Models\PujariModel\Pujari;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PujariSlotController extends Controller
{
    public $limit = 20;

    // \u2500\u2500 List all slots \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function index(Request $request)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $page            = $request->page ?? 1;
            $paginationStart = ($page - 1) * $this->limit;
            $searchString    = $request->searchString ?? null;
            $pujariId        = $request->pujariId ?? null;
            $dayType         = $request->dayType ?? null;
            $status          = $request->status ?? null;

            $query = DB::table('pujari_slots as ps')
                ->join('pujaris', 'pujaris.id', '=', 'ps.pujariId')
                ->select(
                    'ps.*',
                    'pujaris.name as pujariName',
                    'pujaris.profileImage as pujariImage',
                    'pujaris.contactNo as pujariContact',
                )
                ->whereNull('ps.deleted_at')
                ->orderByDesc('ps.id');

            if ($searchString) {
                $query->where('pujaris.name', 'LIKE', "%$searchString%");
            }
            if ($pujariId)  $query->where('ps.pujariId', $pujariId);
            if ($dayType)   $query->where('ps.dayType', $dayType);
            if ($status)    $query->where('ps.status', $status);

            $totalRecords = $query->count();
            $slots        = $query->skip($paginationStart)->take($this->limit)->get();
            $totalPages   = ceil($totalRecords / $this->limit);
            $start        = $paginationStart + 1;
            $end          = min($paginationStart + $this->limit, $totalRecords);

            $pujaris = Pujari::where('isDelete', 0)->where('isVerified', 1)
                             ->orderBy('name')->get(['id','name']);

            $layout = session('layoutName', 'side-menu');

            return view('pages.pujari-slots', compact(
                'slots', 'pujaris', 'searchString', 'pujariId', 'dayType', 'status',
                'totalPages', 'totalRecords', 'start', 'end', 'page', 'layout'
            ));

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    // \u2500\u2500 Add slot (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function store(Request $request)
    {
        try {
            if (!Auth::guard('web')->check())
                return response()->json(['status' => 401, 'message' => 'Unauthorized']);

            // Validate overlapping slot for same pujari/day
            $overlap = $this->checkOverlap(
                $request->pujariId,
                $request->dayType,
                $request->slotDate,
                $request->dayOfWeek,
                $request->startTime,
                $request->endTime
            );

            if ($overlap) {
                return response()->json(['status' => 400, 'message' => 'This time slot overlaps with an existing slot.']);
            }   
            PujariSlot::updateOrCreate(
                ['id' => $request->id], // agar id mile to update
                [
                    'pujariId'    => $request->pujariId,
                    'dayType'     => $request->dayType,
            
                    'slotDate'    => $request->dayType == 'specific'
                                        ? $request->slotDate
                                        : null,
            
                    'dayOfWeek'   => $request->dayType == 'recurring'
                                        ? $request->dayOfWeek
                                        : null,
            
                    'startTime'   => $request->startTime,
                    'endTime'     => $request->endTime,
                    'maxBookings' => $request->maxBookings ?? 1,
            
                    'rate'        => $request->rate, // add this
                    'note'        => $request->note,
            
                    'status'      => 'active',
                    'is_active'   => 1,
            
                    'createdBy'   => Auth::id(),
                ]
            );

            return response()->json(['status' => 200, 'message' => 'Slot added successfully']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Update slot (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function update(Request $request)
    {
        try {
            if (!Auth::guard('web')->check())
                return response()->json(['status' => 401, 'message' => 'Unauthorized']);

            $slot = PujariSlot::findOrFail($request->id);

            $slot->update([
                'dayType'     => $request->dayType,
                'slotDate'    => $request->dayType === 'specific'  ? $request->slotDate  : null,
                'dayOfWeek'   => $request->dayType === 'recurring' ? $request->dayOfWeek : null,
                'startTime'   => $request->startTime,
                'endTime'     => $request->endTime,
                'maxBookings' => $request->maxBookings ?? $slot->maxBookings,
                'note'        => $request->note,
                'modifiedBy'  => Auth::id(),
            ]);

            return response()->json(['status' => 200, 'message' => 'Slot updated']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Toggle status (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function toggleStatus(Request $request)
    {
        try {
            $slot = PujariSlot::findOrFail($request->id);
            $newStatus = $slot->status === 'active' ? 'inactive' : 'active';
            $slot->update(['status' => $newStatus, 'modifiedBy' => Auth::id()]);

            return response()->json([
                'status'    => 200,
                'message'   => 'Status updated',
                'newStatus' => $newStatus,
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Delete slot (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function destroy(Request $request)
    {
        try {
            PujariSlot::findOrFail($request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Slot deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Get slots for a pujari (AJAX \u2014 used by frontend date picker) \u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function getSlotsForPujari(Request $request)
    {
        try {
            $pujariId = $request->pujariId;
            $date     = $request->date; // Y-m-d

            if (!$pujariId || !$date) {
                return response()->json(['status' => 400, 'message' => 'pujariId and date required']);
            }

            $dayOfWeek = (int) date('w', strtotime($date)); // 0=Sun

            $slots = DB::table('pujari_slots')
                ->where('pujariId', $pujariId)
                ->where('status', 'active')
                ->whereNull('deleted_at')
                ->where(function ($q) use ($date, $dayOfWeek) {
                    $q->where(function ($q2) use ($date) {
                        $q2->where('dayType', 'specific')
                           ->where('slotDate', $date);
                    })->orWhere(function ($q2) use ($dayOfWeek) {
                        $q2->where('dayType', 'recurring')
                           ->where('dayOfWeek', $dayOfWeek);
                    });
                })
                ->orderBy('startTime')
                ->get(['id', 'startTime', 'endTime', 'maxBookings', 'bookedCount', 'note']);

            $result = $slots->map(function ($s) {
                $available = $s->bookedCount < $s->maxBookings;
                return [
                    'id'         => $s->id,
                    'label'      => date('h:i A', strtotime($s->startTime)) . ' \u2013 ' . date('h:i A', strtotime($s->endTime)),
                    'startTime'  => $s->startTime,
                    'endTime'    => $s->endTime,
                    'available'  => $available,
                    'remaining'  => max(0, $s->maxBookings - $s->bookedCount),
                    'note'       => $s->note,
                ];
            });

            return response()->json(['status' => 200, 'slots' => $result]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Private: overlap check \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    private function checkOverlap($pujariId, $dayType, $slotDate, $dayOfWeek, $start, $end, $excludeId = null)
    {
        $query = DB::table('pujari_slots')
            ->where('pujariId', $pujariId)
            ->where('dayType', $dayType)
            ->whereNull('deleted_at')
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('startTime', [$start, $end])
                  ->orWhereBetween('endTime', [$start, $end])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->where('startTime', '<=', $start)->where('endTime', '>=', $end);
                  });
            });

        if ($dayType === 'specific') $query->where('slotDate', $slotDate);
        if ($dayType === 'recurring') $query->where('dayOfWeek', $dayOfWeek);
        if ($excludeId) $query->where('id', '!=', $excludeId);

        return $query->exists();
    }
}