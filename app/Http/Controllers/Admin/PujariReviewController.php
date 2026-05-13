<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\PujariModel\PujariReview;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PujariReviewController extends Controller
{
    public $limit = 15;

    /**
     * List all pujari reviews.
     */
    public function getPujariReviews(Request $request)
    {
        try {
            if (!Auth::guard('web')->check()) return redirect('/admin/login');

            $page            = $request->page ?? 1;
            $paginationStart = ($page - 1) * $this->limit;

            $query = DB::table('pujari_reviews as pr')
                ->leftJoin('users',   'users.id',   '=', 'pr.userId')
                ->join('pujaris', 'pujaris.id', '=', 'pr.pujariId')
                ->select(
                    'pr.*',
                    DB::raw("COALESCE(users.name, pr.user_name, 'Admin') as reviewerName"),
                    'users.contactNo as userContactNo',
                    'pujaris.name as pujariName',
                    'pujaris.profileImage'
                )
                ->orderByDesc('pr.id');

            $totalRecords = $query->count();
            $reviews      = $query->skip($paginationStart)->take($this->limit)->get();
            $totalPages   = ceil($totalRecords / $this->limit);
            $start        = $paginationStart + 1;
            $end          = min($paginationStart + $this->limit, $totalRecords);

            // For "Add Review" form dropdown
            $pujaris = Pujari::where('isDelete', 0)->where('isVerified', 1)->get(['id', 'name']);

            $userdatas = DB::table('users as u')
                ->join('user_roles', 'user_roles.userId', '=', 'u.id')
                ->where('u.isDelete', false)
                ->where('user_roles.roleId', 3)
                ->select('u.name as userName', 'u.id as userId', 'u.contactNo', 'u.email')
                ->orderByDesc('u.id')
                ->get();

            return view('pages.pujari-reviews', compact(
                'reviews', 'pujaris', 'userdatas',
                'totalPages', 'totalRecords', 'start', 'end', 'page'
            ));

        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Add a review from admin panel.
     */
    public function addReviewFromAdmin(Request $request)
    {
        try {
            PujariReview::create([
                'pujariId'   => $request->pujariId,
                'userId'     => $request->userId ?? null,
                'user_name'  => $request->user_name,
                'review'     => $request->review,
                'comment'     => $request->review,
                'rating'     => $request->rating,
                'createdBy'  => Auth::id(),
                'modifiedBy' => Auth::id(),
            ]);

            return response()->json(['status' => 200, 'message' => 'Review added successfully']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a review.
     */
    public function deleteReview(Request $request)
    {
        try {
            PujariReview::where('id', $request->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Review deleted']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}