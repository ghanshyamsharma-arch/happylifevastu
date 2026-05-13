<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\PujariModel\PujariBooking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PujariBookingController extends Controller
{
    public $limit = 15;

    /**
     * List all pujari bookings.
     */
    public function index(Request $request)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $page            = $request->page ?? 1;
            $paginationStart = ($page - 1) * $this->limit;
            $searchString    = $request->searchString ?? null;
            $status          = $request->status ?? null;
            $from_date       = $request->from_date ?? null;
            $to_date         = $request->to_date ?? null;

            $query = DB::table('pujari_bookings as pb')
                ->join('pujaris', 'pujaris.id', '=', 'pb.pujariId')
                ->leftJoin('users', 'users.id', '=', 'pb.userId')
                ->select(
                    'pb.*',
                    'pujaris.name as pujariName',
                    'pujaris.profileImage',
                    'pujaris.contactNo as pujariContact',
                    'users.name as customerName',
                    'users.contactNo as customerContact'
                )
                ->whereNull('pb.deleted_at')
                ->orderByDesc('pb.id');

            if ($searchString) {
                $query->where(function ($q) use ($searchString) {
                    $q->where('pujaris.name',   'LIKE', "%$searchString%")
                      ->orWhere('pb.personName', 'LIKE', "%$searchString%")
                      ->orWhere('pb.personContact', 'LIKE', "%$searchString%")
                      ->orWhere('pb.pujaName',   'LIKE', "%$searchString%");
                });
            }

            if ($status) $query->where('pb.status', $status);

            if ($from_date && $to_date) {
                $query->whereBetween('pb.created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
            }

            $totalRecords = $query->count();
            $bookings     = $query->skip($paginationStart)->take($this->limit)->get();
            $totalPages   = ceil($totalRecords / $this->limit);
            $start        = $paginationStart + 1;
            $end          = min($paginationStart + $this->limit, $totalRecords);

            $currency = DB::table('systemflag')->where('name', 'currencySymbol')->select('value')->first();

            return view('pages.pujari-bookings', compact(
                'bookings', 'searchString', 'status', 'from_date', 'to_date',
                'totalPages', 'totalRecords', 'start', 'end', 'page', 'currency'
            ));

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Show single booking detail.
     */
    public function show($id)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $booking = DB::table('pujari_bookings as pb')
                ->join('pujaris', 'pujaris.id', '=', 'pb.pujariId')
                ->leftJoin('users', 'users.id', '=', 'pb.userId')
                ->select(
                    'pb.*',
                    'pujaris.name as pujariName',
                    'pujaris.profileImage',
                    'pujaris.contactNo as pujariContact',
                    'pujaris.email as pujariEmail',
                    'users.name as customerName',
                    'users.contactNo as customerContact',
                    'users.email as customerEmail'
                )
                ->where('pb.id', $id)
                ->first();

            if (!$booking) abort(404);

            $currency = DB::table('systemflag')->where('name', 'currencySymbol')->select('value')->first();

            return view('pages.pujari-booking-detail', compact('booking', 'currency'));

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Update booking status.
     * POST: { id, status, adminNote? }
     */
    public function updateStatus(Request $request)
    {
        try {
            PujariBooking::where('id', $request->id)->update([
                'status'     => $request->status,
                'adminNote'  => $request->adminNote ?? null,
                'modifiedBy' => Auth::id(),
            ]);

            return response()->json(['status' => 200, 'message' => 'Booking status updated']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete booking (soft delete).
     */
    public function destroy(Request $request)
    {
        try {
            PujariBooking::where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Booking deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}