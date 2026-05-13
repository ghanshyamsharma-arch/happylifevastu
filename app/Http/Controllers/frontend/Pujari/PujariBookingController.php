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
    // ────── Booking Page with Available Slots ────────────────────────────────
    public function bookingPage(Request $request, $slug)
    {
        $pujari = Pujari::where('slug', $slug)
            ->where('isDelete', 0)
            ->where('isVerified', 1)
            ->firstOrFail();

        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->value('value') ?? '₹';
        $gstPct = (float)(DB::table('systemflag')->where('name', 'gstPercent')->value('value') ?? 0);

        // Get available slots for next 30 days
        $slots = DB::table('pujari_slots')
            ->where('pujariId', $pujari->id)
            ->where('slotDate', '>=', date('Y-m-d'))
            ->where('slotDate', '<=', date('Y-m-d', strtotime('+30 days')))
            ->where('is_active', 1)
            ->whereRaw('bookedCount < maxBookings')  // Slot not fully booked
            ->orderBy('slotDate', 'asc')
            ->orderBy('startTime', 'asc')
            ->get();

        // Get user's profile data if logged in (for auto-fill)
        $userProfile = Auth::check() ? Auth::user() : null;

        return view('frontend.pages.pujari-booking', compact(
            'pujari', 'currency', 'gstPct', 'slots', 'userProfile'
        ));
    }

    // ────── Place Booking with Slot Selection ──────────────────────────────
    public function placeBooking(Request $request)
    {
        try {
            // Get user ID if logged in, otherwise null (guest booking allowed)
            $userId = authcheck()['id'];

            // Validate required fields
            if (empty($request->pujariId) || empty($request->slotId) || 
                empty($request->personName) || empty($request->personContact)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Please fill all required fields.'
                ]);
            }

            // Get slot details
            $slot = DB::table('pujari_slots')
                ->where('id', $request->slotId)
                ->where('pujariId', $request->pujariId)
                ->where('is_active', 1)
                ->whereRaw('bookedCount < maxBookings')
                ->whereNull('deleted_at')
                ->first();

            if (!$slot) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Selected slot is no longer available or fully booked.'
                ]);
            }

            // Check if user already booked this slot (only if logged in)
            if ($userId) {
                $alreadyBooked = DB::table('pujari_bookings')
                    ->where('slotId', $slot->id)
                    ->where('userId', $userId)
                    ->whereNotIn('status', ['cancelled'])
                    ->whereNull('deleted_at')
                    ->exists();

                if ($alreadyBooked) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'You have already booked this slot.'
                    ]);
                }
            }

            // Calculate amount and GST
            $gstPct = (float)(DB::table('systemflag')->where('name', 'gstPercent')->value('value') ?? 0);
            $amount = (float)$slot->rate;
            $gstAmount = $gstPct > 0 ? round($amount * ($gstPct / 100), 2) : 0;
            $totalAmount = $amount + $gstAmount;

            // Format time slot for display
            $timeSlot = date('h:i A', strtotime($slot->startTime)) . ' – ' . 
                       date('h:i A', strtotime($slot->endTime));

            // Create booking
            $booking = PujariBooking::create([
                'pujariId' => $request->pujariId,
                'userId' => $userId, // Can be null for guest bookings
                'slotId' => $request->slotId,
                'bookingDate' => $slot->slotDate,
                'timeSlot' => $timeSlot,
                'personName' => $request->personName,
                'personContact' => $request->personContact,
                'personEmail' => $request->personEmail ?? ($userId ? Auth::user()->email : ''),
                'pujaName' => $request->pujaName,
                'gotra' => $request->gotra,
                'familyMemberNames' => $request->familyMemberNames,
                'address' => $request->address,
                'specialRequirement' => $request->specialRequirement,
                'location' => $request->location ?? 'online',
                'amount' => $amount,
                'gstAmount' => $gstAmount,
                'totalAmount' => $totalAmount,
                'paymentMode' => $request->paymentMode ?? 'manual',
                'paymentStatus' => 'pending',
                'status' => 'pending',
                'createdBy' => $userId, // Can be null
            ]);

            // Mark slot as booked by incrementing bookedCount
            DB::table('pujari_slots')
                ->where('id', $slot->id)
                ->increment('bookedCount');

            return response()->json([
                'status' => 200,
                'message' => 'Booking confirmed! We will contact you shortly.',
                'bookingId' => $booking->id,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // ────── Get Available Slots (AJAX) ──────────────────────────────────────
    public function getAvailableSlots(Request $request)
    {
        try {
            $slots = DB::table('pujari_slots')
                ->where('pujariId', $request->pujariId)
                ->where('isActive', 1)
                ->where('isBooked', 0)
                ->where('date', '>=', date('Y-m-d'))
                ->orderBy('date', 'asc')
                ->orderBy('startTime', 'asc')
                ->get();

            return response()->json([
                'status' => 200,
                'slots' => $slots->map(function ($slot) {
                    return [
                        'id' => $slot->id,
                        'date' => $slot->date,
                        'dateFormatted' => date('d M, Y', strtotime($slot->date)),
                        'startTime' => $slot->startTime,
                        'endTime' => $slot->endTime,
                        'timeFormatted' => date('h:i A', strtotime($slot->startTime)) . ' – ' . 
                                          date('h:i A', strtotime($slot->endTime)),
                        'rate' => $slot->rate,
                    ];
                })
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ────── Submit Review (AJAX) ───────────────────────────────────────────
    public function submitReview(Request $request)
    {
        try {
             $userId = authcheck()['id'];
           
            if (!$userId) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Please login to submit a review.',
                    'redirect' => route('front.pujariLogin')
                ], 401);
            }

            $exists = PujariReview::where('pujariId', $request->pujariId)
                ->where('userId', $userId)
                ->exists();

            if ($exists) {
                return response()->json([
                    'status' => 400,
                    'message' => 'You have already reviewed this pujari.'
                ]);
            }

            if (empty($request->rating)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Please select a rating.'
                ]);
            }

            PujariReview::create([
                'pujariId' => $request->pujariId,
                'userId' => $userId,
                'user_name' => Auth::user()->name,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_approved' => 0,
                'created_at' => now(),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Thank you for your review! It will appear after admin approval.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ────── Block / Unblock Pujari (AJAX) ──────────────────────────────────
    public function blockPujari(Request $request)
    {
        try {
             $userId = authcheck()['id'];

            if (!$userId) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Please login.',
                    'redirect' => route('front.pujariLogin')
                ], 401);
            }

            $pujariId = $request->pujariId;
            $exists = DB::table('block_pujari')
                ->where('pujariId', $pujariId)
                ->where('userId', $userId)
                ->exists();

            if ($exists) {
                DB::table('block_pujari')
                    ->where('pujariId', $pujariId)
                    ->where('userId', $userId)
                    ->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Pujari unblocked',
                    'action' => 'Unblocked'
                ]);
            } else {
                DB::table('block_pujari')->insert([
                    'pujariId' => $pujariId,
                    'userId' => $userId,
                    'reason' => $request->reason ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Pujari blocked successfully',
                    'action' => 'Blocked'
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ────── Update Booking Status (Pujari Portal) ──────────────────────────
    public function updateBookingStatus(Request $request)
    {
        try {
            $pujari = session('pujari');
            if (!$pujari) {
                return back()->with('error', 'Please login to manage bookings.');
            }

            $booking = DB::table('pujari_bookings')
                ->where('id', $request->booking_id)
                ->where('pujariId', $pujari['id'])
                ->first();

            if (!$booking) {
                return back()->with('error', 'Booking not found.');
            }

            if (in_array($booking->status, ['completed', 'cancelled'])) {
                return back()->with('error', 'This booking status cannot be changed.');
            }

            $update = ['status' => $request->status];

            // If cancelling - free up the slot
            if ($request->status === 'cancelled' && $booking->slotId) {
                DB::table('pujari_slots')
                    ->where('id', $booking->slotId)
                    ->update(['isBooked' => 0]);
            }

            if ($booking->status === 'confirmed' && $request->status === 'completed') {
                $update['paymentStatus'] = 'paid';
            }

            DB::table('pujari_bookings')
                ->where('id', $request->booking_id)
                ->update($update);

            return back()->with('success', 'Booking status updated successfully.');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}