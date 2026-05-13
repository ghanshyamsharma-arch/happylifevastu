<?php

namespace App\Http\Controllers\Frontend\Pujari;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\PujariModel\PujariBooking;
use App\Models\PujariModel\PujariReview;
use App\Models\PujariModel\PujariSlot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PujariBookingController extends Controller
{
    // \u2500\u2500 Booking Page \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function bookingPage(Request $request, $slug)
    {
        $pujari   = Pujari::where('slug', $slug)->where('isDelete', 0)->where('isVerified', 1)->firstOrFail();
        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->value('value') ?? '\u20b9';
        $gstPct   = DB::table('systemflag')->where('name', 'gstPercent')->value('value') ?? 0;
        $logo     = DB::table('systemflag')->where('name', 'logo')->value('value');

        return view('frontend.pages.pujari-booking', compact('pujari', 'currency', 'gstPct', 'logo'));
    }

    // \u2500\u2500 Place Booking (AJAX) \u2014 slot-aware \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function placeBooking(Request $request)
    {
        try {
            $userId = authcheck() ? authcheck()['id'] : Auth::id();

            if (!$userId) {
                return response()->json(['status' => 401, 'message' => 'Please login to place a booking.', 'redirect' => route('front.login')], 401);
            }

            $gstPct    = (float)(DB::table('systemflag')->where('name', 'gstPercent')->value('value') ?? 0);
            $amount    = (float)($request->amount ?? 0);
            $gstAmount = $gstPct > 0 ? round($amount * ($gstPct / 100), 2) : 0;
            $total     = $amount + $gstAmount;

            if (empty($request->pujariId) || empty($request->personName) || empty($request->personContact) || empty($request->bookingDate)) {
                return response()->json(['status' => 400, 'message' => 'Please fill all required fields.']);
            }

            // \u2500\u2500 Slot handling \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
            $slotId   = null;
            $timeSlot = $request->timeSlot;

            if ($request->slotId) {
                $slot = DB::table('pujari_slots')
                    ->where('id', $request->slotId)
                    ->where('pujariId', $request->pujariId)
                    ->where('status', 'active')
                    ->whereNull('deleted_at')
                    ->first();

                if (!$slot) {
                    return response()->json(['status' => 400, 'message' => 'Selected slot is no longer available.']);
                }

                if ($slot->bookedCount >= $slot->maxBookings) {
                    return response()->json(['status' => 400, 'message' => 'This slot is fully booked. Please choose another.']);
                }

                // Check if same user already booked this slot on this date
                $alreadyBooked = DB::table('pujari_bookings')
                    ->where('slotId', $slot->id)
                    ->where('userId', $userId)
                    ->where('bookingDate', $request->bookingDate)
                    ->whereNotIn('status', ['cancelled'])
                    ->whereNull('deleted_at')
                    ->exists();

                if ($alreadyBooked) {
                    return response()->json(['status' => 400, 'message' => 'You have already booked this slot.']);
                }

                $slotId   = $slot->id;
                $timeSlot = date('h:i A', strtotime($slot->startTime)) . ' \u2013 ' . date('h:i A', strtotime($slot->endTime));

                // Increment bookedCount
                DB::table('pujari_slots')->where('id', $slotId)->increment('bookedCount');

                // Auto-mark slot as full if maxed out
                if (($slot->bookedCount + 1) >= $slot->maxBookings) {
                    DB::table('pujari_slots')->where('id', $slotId)->update(['status' => 'full']);
                }
            }

            $booking = PujariBooking::create([
                'pujariId'           => $request->pujariId,
                'userId'             => $userId,
                'slotId'             => $slotId,
                'bookingType'        => $request->bookingType ?? 'session',
                'bookingDate'        => $request->bookingDate,
                'timeSlot'           => $timeSlot,
                'specialRequirement' => $request->specialRequirement,
                'location'           => $request->location ?? 'online',
                'personName'         => $request->personName,
                'personContact'      => $request->personContact,
                'personEmail'        => $request->personEmail,
                'address'            => $request->address,
                'pujaName'           => $request->pujaName,
                'gotra'              => $request->gotra,
                'familyMemberNames'  => $request->familyMemberNames,
                'amount'             => $amount,
                'gstAmount'          => $gstAmount,
                'totalAmount'        => $total,
                'paymentMode'        => $request->paymentMode ?? 'manual',
                'paymentStatus'      => 'pending',
                'status'             => 'pending',
                'createdBy'          => $userId,
            ]);

            return response()->json([
                'status'    => 200,
                'message'   => 'Booking placed successfully! We will contact you shortly.',
                'bookingId' => $booking->id,
            ]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Submit Review (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function submitReview(Request $request)
    {
        try {
            $userId = authcheck() ? authcheck()['id'] : Auth::id();

            if (!$userId) {
                return response()->json(['status' => 401, 'message' => 'Please login to submit a review.', 'redirect' => route('front.login')], 401);
            }

            $exists = PujariReview::where('pujariId', $request->pujariId)
                ->where('userId', $userId)->exists();

            if ($exists) {
                return response()->json(['status' => 400, 'message' => 'You have already reviewed this pujari.']);
            }

            if (empty($request->rating)) {
                return response()->json(['status' => 400, 'message' => 'Please select a rating.']);
            }

            PujariReview::create([
                'pujariId'  => $request->pujariId,
                'userId'    => $userId,
                'user_name' => Auth::user()->name ?? authcheck()['name'] ?? 'User',
                'rating'    => $request->rating,
                'review'    => $request->review,
                'isPublic'  => 1,
                'createdBy' => $userId,
            ]);

            return response()->json([
                'status'   => 200,
                'message'  => 'Thank you for your review!',
                'userName' => Auth::user()->name ?? authcheck()['name'] ?? 'User',
                'profile'  => Auth::user()->profile ?? null,
            ]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Block / Unblock Pujari (AJAX) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function blockPujari(Request $request)
    {
        try {
            $userId = authcheck() ? authcheck()['id'] : Auth::id();

            if (!$userId) {
                return response()->json(['status' => 401, 'message' => 'Please login.', 'redirect' => route('front.login')], 401);
            }

            $pujariId = $request->pujariId;
            $exists   = DB::table('block_pujari')->where('pujariId', $pujariId)->where('userId', $userId)->exists();

            if ($exists) {
                DB::table('block_pujari')->where('pujariId', $pujariId)->where('userId', $userId)->delete();
                return response()->json(['status' => 200, 'message' => 'Pujari unblocked', 'action' => 'unblocked']);
            } else {
                DB::table('block_pujari')->insert([
                    'pujariId'   => $pujariId,
                    'userId'     => $userId,
                    'reason'     => $request->reason ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return response()->json(['status' => 200, 'message' => 'Pujari blocked successfully', 'action' => 'blocked']);
            }

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500 Update Booking Status (Portal) \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    public function updateBookingStatus(Request $request)
    {
        try {
            $pujari = PujariAuthController::pujariAuthCheck();
            if (!$pujari) return back()->with('error', 'Not logged in.');

            $booking = DB::table('pujari_bookings')
                ->where('id', $request->booking_id)
                ->where('pujariId', $pujari->pujariId)
                ->first();

            if (!$booking) return back()->with('error', 'Booking not found.');

            if (in_array($booking->status, ['completed', 'cancelled'])) {
                return back()->with('error', 'Status cannot be changed.');
            }

            $update = ['status' => $request->status];

            // If cancelling \u2014 free up the slot
            if ($request->status === 'cancelled' && $booking->slotId) {
                DB::table('pujari_slots')->where('id', $booking->slotId)
                    ->where('bookedCount', '>', 0)
                    ->decrement('bookedCount');
                // Re-activate if was full
                DB::table('pujari_slots')->where('id', $booking->slotId)
                    ->where('status', 'full')
                    ->update(['status' => 'active']);
            }

            if ($booking->status === 'confirmed' && $request->status === 'completed') {
                $update['paymentStatus'] = 'paid';
            }

            DB::table('pujari_bookings')->where('id', $request->booking_id)->update($update);

            return back()->with('success', 'Booking status updated successfully.');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}