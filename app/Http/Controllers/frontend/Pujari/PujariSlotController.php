<?php

namespace App\Http\Controllers\Frontend\Pujari;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\PujariSlot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PujariSlotController extends Controller
{
    // \u2500\u2500 List slots page \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function index()
    {
        $pujari = PujariAuthController::pujariAuthCheck();
        if (!$pujari) return redirect()->route('front.pujariLogin');

        $slots = DB::table('pujari_slots')
            ->where('pujariId', $pujari->pujariId)
            ->whereNull('deleted_at')
            ->orderByRaw("FIELD(dayType,'recurring','specific')")
            ->orderBy('dayOfWeek')
            ->orderBy('slotDate')
            ->orderBy('startTime')
            ->get();

        return view('frontend.pujari.my-slots', compact('pujari', 'slots'));
    }

    // \u2500\u2500 Add slot (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function store(Request $request)
    {
        try {
            $pujari = PujariAuthController::pujariAuthCheck();
            if (!$pujari) return response()->json(['status' => 401, 'message' => 'Not logged in']);

            // Overlap check
            if ($this->checkOverlap(
                $pujari->pujariId,
                $request->dayType,
                $request->slotDate,
                $request->dayOfWeek,
                $request->startTime,
                $request->endTime,
                $request->rate
            )) {
                return response()->json(['status' => 400, 'message' => 'This time overlaps with an existing slot.']);
            }

            PujariSlot::create([
                'pujariId'    => $pujari->pujariId,
                'dayType'     => $request->dayType,
                'slotDate'    => $request->dayType === 'specific'  ? $request->slotDate  : null,
                'dayOfWeek'   => $request->dayType === 'recurring' ? $request->dayOfWeek : null,
                'startTime'   => $request->startTime,
                'endTime'     => $request->endTime,
                'maxBookings' => $request->maxBookings ?? 1,
                'status'      => 'active',
                'note'        => $request->note,
                'rate'        => $request->rate,
                'createdBy'   => $pujari->id,
            ]);

            return response()->json(['status' => 200, 'message' => 'Slot added successfully!']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Update slot (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function update(Request $request)
    {
        try {
            $pujari = PujariAuthController::pujariAuthCheck();
            if (!$pujari) return response()->json(['status' => 401, 'message' => 'Not logged in']);

            $slot = PujariSlot::where('id', $request->id)
                              ->where('pujariId', $pujari->pujariId)
                              ->firstOrFail();
            
            $resp=$slot->update([
                'dayType'     => $request->dayType,
                'slotDate'    => $request->dayType === 'specific'  ? $request->slotDate  : null,
                'dayOfWeek'   => $request->dayType === 'recurring' ? $request->dayOfWeek : null,
                'startTime'   => $request->startTime,
                'endTime'     => $request->endTime,
                'maxBookings' => $request->maxBookings ?? $slot->maxBookings,
                'rate'        => $request->rate ?? $slot->rate,
                'note'        => $request->note,
                'modifiedBy'  => $pujari->id,
            ]);
            
            return response()->json(['status' => 200, 'message' => 'Slot updated!' .$request->rate]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Toggle status (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function toggleStatus(Request $request)
    {
        try {
            $pujari = PujariAuthController::pujariAuthCheck();
            if (!$pujari) return response()->json(['status' => 401, 'message' => 'Not logged in']);

            $slot = PujariSlot::where('id', $request->id)
                              ->where('pujariId', $pujari->pujariId)
                              ->firstOrFail();

            $new = $slot->status === 'active' ? 'inactive' : 'active';
            $slot->update(['status' => $new, 'modifiedBy' => $pujari->id]);

            return response()->json(['status' => 200, 'newStatus' => $new, 'message' => "Slot $new"]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Delete slot (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function destroy(Request $request)
    {
        try {
            $pujari = PujariAuthController::pujariAuthCheck();
            if (!$pujari) return response()->json(['status' => 401, 'message' => 'Not logged in']);

            PujariSlot::where('id', $request->id)
                      ->where('pujariId', $pujari->pujariId)
                      ->firstOrFail()
                      ->delete();

            return response()->json(['status' => 200, 'message' => 'Slot deleted']);

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

        if ($dayType === 'specific')  $query->where('slotDate', $slotDate);
        if ($dayType === 'recurring') $query->where('dayOfWeek', $dayOfWeek);
        if ($excludeId) $query->where('id', '!=', $excludeId);

        return $query->exists();
    }
}