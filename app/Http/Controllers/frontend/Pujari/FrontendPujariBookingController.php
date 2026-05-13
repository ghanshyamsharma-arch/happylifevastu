<?php

namespace App\Http\Controllers\Frontend\Pujari;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\PujariModel\PujariBooking;
use App\Models\PujariModel\PujariReview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PujariBookingController extends Controller
{
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // BOOKING PAGE (user clicks "Book Now" on pujari detail page)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function bookingPage(Request $request, $slug)
    {
        $pujari   = Pujari::where('slug', $slug)->where('isDelete', 0)->where('isVerified', 1)->firstOrFail();
        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->value('value') ?? '\u20b9';
        $gstPct   = DB::table('systemflag')->where('name', 'gstPercent')->value('value') ?? 0;
        $logo     = DB::table('systemflag')->where('name', 'logo')->value('value');

        return view('frontend.pages.pujari-booking', compact('pujari', 'currency', 'gstPct', 'logo'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // PLACE BOOKING (AJAX)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function placeBooking(Request $request)
    {
        try {
            // Guest or logged-in user
            $userId = Auth::id() ?? null;

            $gstPct    = (float)(DB::table('systemflag')->where('name', 'gstPercent')->value('value') ?? 0);
            $amount    = (float)($request->amount ?? 0);
            $gstAmount = $gstPct > 0 ? round($amount * ($gstPct / 100), 2) : 0;
            $total     = $amount + $gstAmount;

            $booking = PujariBooking::create([
                'pujariId'           => $request->pujariId,
                'userId'             => $userId,
                'bookingType'        => $request->bookingType ?? 'session',
                'bookingDate'        => $request->bookingDate,
                'timeSlot'           => $request->timeSlot,
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
                'paymentMode'        => $request->paymentMode ?? 'online',
                'paymentStatus'      => 'pending',
                'status'             => 'pending',
                'createdBy'          => $userId,
            ]);

            return response()->json([
                'status'     => 200,
                'message'    => 'Booking placed successfully! We will contact you shortly.',
                'bookingId'  => $booking->id,
            ]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // SUBMIT REVIEW (user submits review on pujari detail page)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function submitReview(Request $request)
    {
        try {
            $userId = Auth::id() ?? null;

            // Prevent duplicate review
            if ($userId) {
                $exists = PujariReview::where('pujariId', $request->pujariId)
                    ->where('userId', $userId)
                    ->exists();
                if ($exists) {
                    return response()->json(['status' => 400, 'message' => 'You have already reviewed this pujari']);
                }
            }

            PujariReview::create([
                'pujariId'   => $request->pujariId,
                'userId'     => $userId,
                'user_name'  => $request->user_name ?? (Auth::user()->name ?? 'Anonymous'),
                'rating'     => $request->rating,
                'review'     => $request->review,
                'isPublic'   => 1,
                'createdBy'  => $userId,
            ]);

            return response()->json(['status' => 200, 'message' => 'Thank you for your review!']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // BLOCK PUJARI (user blocks a pujari from pujari detail page)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function blockPujari(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['status' => 401, 'message' => 'Please login to perform this action']);
            }

            $userId   = Auth::id();
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
}