<?php

namespace App\Http\Controllers\Frontend\Pujari;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\AdminModel\SystemFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PujariController extends Controller
{
    // ── Pujari listing page ───────────────────────────────────────────────────
    public function getPujariList(Request $request)
    {
        Artisan::call('cache:clear');

        $pujaris = Pujari::where('isDelete', 0)
            ->where('isVerified', 1)
            ->where('isActive', 1)
            ->when($request->search, fn($q) =>
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('primarySkill', 'LIKE', '%' . $request->search . '%')
            )
            ->orderBy('id', 'DESC')
            ->paginate(12);

        $currency   = SystemFlag::where('name', 'currencySymbol')->first();
        $walletType = strtolower(SystemFlag::where('name', 'walletType')->value('value') ?? 'inr');
        $coinIcon   = SystemFlag::where('name', 'coinIcon')->value('value') ?? '';

        return view('frontend.pages.pujari-list', compact('pujaris', 'currency', 'walletType', 'coinIcon'));
    }

    // ── Pujari detail page ────────────────────────────────────────────────────
    public function getPujariDetails(Request $request, $slug)
    {
        Artisan::call('cache:clear');

        $pujari = Pujari::where('slug', $slug)
            ->where('isDelete', 0)
            ->where('isVerified', 1)
            ->firstOrFail();
       
        $currency   = SystemFlag::where('name', 'currencySymbol')->first();
        $walletType = strtolower(SystemFlag::where('name', 'walletType')->value('value') ?? 'inr');
        $coinIcon   = SystemFlag::where('name', 'coinIcon')->value('value') ?? '';
        $gstPct     = (float)(SystemFlag::where('name', 'gstPercent')->value('value') ?? 0);

        // Pujas assigned to this pujari
        $pujas = DB::table('pujas as p')
            ->leftJoin('puja_categories as pc', 'pc.id', '=', 'p.category_id')
            ->where('p.astrologerId', $pujari->id)
            ->where('p.puja_status', 1)
            ->where('p.isAdminApproved', 'Approved')
            ->select('p.*', 'pc.name as categoryName')
            ->get();

        // Reviews from pujari_reviews table
        $review = DB::table('pujari_reviews as pr')
            ->leftJoin('users as us', 'us.id', '=', 'pr.userId')
            ->where('pr.pujariId', $pujari->id)
            ->where('pr.is_approved', 1)
            ->select('pr.*', 'us.profile', DB::raw('IFNULL(us.name, pr.user_name) as userName'))
            ->orderBy('pr.id', 'DESC')
            ->get();

        $totalReviews = $review->count();
        $avgRating    = $totalReviews ? round($review->avg('rating'), 1) : 0;

        // Total bookings (all statuses including pending)
        $totalBookings = DB::table('pujari_bookings')
            ->where('pujariId', $pujari->id)
            ->whereNull('deleted_at')
            ->count();

        // Has logged-in user already reviewed?
        $hasReviewed = false;
        if (Auth::check()) {
            $hasReviewed = DB::table('pujari_reviews')
                ->where('pujariId', $pujari->id)
                ->where('userId', Auth::id())
                ->exists();
        }

        // Is logged-in user this pujari themselves?
        $isSelf = false;
        $exists=false;
        if (authcheck()) {
            $userId = authcheck()['id'];
            $isSelf = DB::table('pujaris')
                ->where('id', $pujari->id)
                ->where('userId', $userId)
                ->exists();
                
                $exists = DB::table('block_pujari')
                ->where('pujariId', $pujari->id)
                ->where('userId', $userId)
                ->exists();
        }
        
        return view('frontend.pages.pujari-details', compact(
            'pujari', 'currency', 'walletType', 'coinIcon', 'gstPct',
            'pujas', 'review', 'totalReviews', 'avgRating',
            'totalBookings', 'hasReviewed', 'isSelf','exists'
        ));
    }

    // ── Registration page ─────────────────────────────────────────────────────
    public function registerPage()
    {
        return view('frontend.pages.pujari-register');
    }
}