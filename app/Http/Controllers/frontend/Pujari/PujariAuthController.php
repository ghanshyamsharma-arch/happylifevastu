<?php

namespace App\Http\Controllers\Frontend\Pujari;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\PujariBooking;
use App\Models\PujariModel\PujariReview;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Session\Session;

class PujariAuthController extends Controller
{
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // AUTH CHECK HELPER
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    /**
     * Check if pujari is logged in via JWT session.
     * Returns pujari data array or false.
     */
    public static function pujariAuthCheck()
    {
        $session = new Session();
        $token   = $session->get('pujaritoken');

        if (!$token) return false;

        try {
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) return false;

            $pujari = DB::table('pujaris')
                ->where('userId', $user->id)
                ->where('isDelete', 0)
                ->first();

            if (!$pujari) return false;

            $user->pujariId   = $pujari->id;
            $user->pujariData = $pujari;

            return $user;
        } catch (Exception $e) {
            return false;
        }
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // LOGIN PAGE
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function loginPage()
    {
        // Already logged in \u2192 redirect to dashboard
        if (self::pujariAuthCheck()) {
            return redirect()->route('front.pujariDashboard');
        }

        $logo    = DB::table('systemflag')->where('name', 'logo')->value('value');
        $appname = DB::table('systemflag')->where('name', 'appName')->value('value');

        return view('frontend.pujari.pages.login', compact('logo', 'appname'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // REGISTER PAGE
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function registerPage()
    {
        if (self::pujariAuthCheck()) {
            return redirect()->route('front.pujariDashboard');
        }

        $logo    = DB::table('systemflag')->where('name', 'logo')->value('value');
        $appname = DB::table('systemflag')->where('name', 'appName')->value('value');

        return view('frontend.pujari.pages.register', compact('logo', 'appname'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // VERIFY OTP & LOGIN (AJAX)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function verifyAndLogin(Request $request)
    {
        try {
            // 1. Verify OTP via Msg91 if not Google login
            if (empty($request->isGoogleLogin)) {
                $msg91AuthKey    = DB::table('systemflag')->where('name', 'msg91AuthKey')->value('value');
                $formattedCode   = ltrim($request->countryCode ?? '91', '+');
                $fullMobile      = $formattedCode . $request->contactNo;

                $response = Http::withHeaders(['authkey' => $msg91AuthKey])
                    ->get('https://control.msg91.com/api/v5/otp/verify', [
                        'otp'    => $request->otp,
                        'mobile' => $fullMobile,
                    ]);

                if (!$response->successful()) {
                    return response()->json(['status' => 400, 'message' => 'OTP verification failed']);
                }
            }
            //  return response()->json(['status' => 400, 'message' => 'OTP verification failed','data'=>$_REQUEST]);
            // 2. Hit internal API to get JWT token
            $loginPayload = $request->isGoogleLogin
                ? ['email' => $request->email]
                : ['contactNo' => $request->contactNo];
            $data = json_decode(json_encode($_REQUEST));
            if(isset($data->phone)){
                $data->contactNo=$data->phone;
            }
            $login = Http::withoutVerifying()
                ->post(url('/') . '/api/loginPujari', $data)
                ->json();
            
            if (($login['status'] ?? 400) != 200) {
                return response()->json(['status' => 400, 'message' => $login['message'] ?? 'Login failed']);
            }

            // 3. Store token in session
            $session = new Session();
            $session->set('pujaritoken', $login['token']);

            return response()->json(['status' => 200, 'message' => 'Login successful']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // SEND OTP (AJAX)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function sendOtp(Request $request)
    {
        try {
            $msg91AuthKey  = DB::table('systemflag')->where('name', 'msg91AuthKey')->value('value');
            $msg91Template = DB::table('systemflag')->where('name', 'msg91OtpTemplateId')->value('value');
            $formattedCode = ltrim($request->countryCode ?? '91', '+');
            $fullMobile    = $formattedCode . $request->contactNo;

            $response = Http::withHeaders(['authkey' => $msg91AuthKey])
                ->post('https://control.msg91.com/api/v5/otp', [
                    'mobile'     => $fullMobile,
                    'template_id' => $msg91Template,
                ]);

            if ($response->successful()) {
                return response()->json(['status' => 200, 'message' => 'OTP sent']);
            }

            return response()->json(['status' => 400, 'message' => 'Failed to send OTP']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // LOGOUT
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function logout(Request $request)
    {
        $session = new Session();
        $session->remove('pujaritoken');
        return redirect()->route('front.pujariLogin');
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // DASHBOARD
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function dashboard(Request $request)
    {
        $user = self::pujariAuthCheck();
        if (!$user) return redirect()->route('front.pujariLogin');

        $pujariId = $user->pujariId;
        $pujari   = $user->pujariData;

        // Stats
        $totalBookings    = DB::table('pujari_bookings')->where('pujariId', $pujariId)->whereNull('deleted_at')->count();
        $pendingBookings  = DB::table('pujari_bookings')->where('pujariId', $pujariId)->where('status', 'pending')->whereNull('deleted_at')->count();
        $completedBookings = DB::table('pujari_bookings')->where('pujariId', $pujariId)->where('status', 'completed')->whereNull('deleted_at')->count();
        $totalEarnings    = DB::table('pujari_bookings')->where('pujariId', $pujariId)->where('paymentStatus', 'paid')->whereNull('deleted_at')->sum('totalAmount');
        $avgRating        = DB::table('pujari_reviews')->where('pujariId', $pujariId)->avg('rating') ?? 0;
        $totalReviews     = DB::table('pujari_reviews')->where('pujariId', $pujariId)->count();

        // Recent bookings
        $recentBookings = DB::table('pujari_bookings as pb')
            ->leftJoin('users', 'users.id', '=', 'pb.userId')
            ->where('pb.pujariId', $pujariId)
            ->whereNull('pb.deleted_at')
            ->select('pb.*', 'users.name as customerName', 'users.contactNo as customerContact')
            ->orderByDesc('pb.id')
            ->limit(5)
            ->get();

        // Recent reviews
        $recentReviews = DB::table('pujari_reviews as pr')
            ->leftJoin('users', 'users.id', '=', 'pr.userId')
            ->where('pr.pujariId', $pujariId)
            ->select('pr.*', DB::raw("COALESCE(users.name, pr.user_name, 'Anonymous') as reviewerName"))
            ->orderByDesc('pr.id')
            ->limit(5)
            ->get();

        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->value('value') ?? '\u20b9';

        return view('frontend.pujari.dashboard', compact(
            'pujari', 'pujariId',
            'totalBookings', 'pendingBookings', 'completedBookings', 'totalEarnings',
            'avgRating', 'totalReviews', 'recentBookings', 'recentReviews', 'currency'
        ));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // MY BOOKINGS (pujari portal)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function myBookings(Request $request)
    {
        $user = self::pujariAuthCheck();

        if (!$user) return redirect()->route('front.pujariLogin');
        $pujariId = $user->pujariId;
        $status   = $request->status ?? null;

        $query = DB::table('pujari_bookings as pb')
            ->leftJoin('users', 'users.id', '=', 'pb.userId')
            ->where('pb.pujariId', $pujariId)
            ->whereNull('pb.deleted_at')
            ->select('pb.*', 'users.name as customerName', 'users.contactNo as customerContact')
            ->orderByDesc('pb.id');

        if ($status) $query->where('pb.status', $status);

        $bookings = $query->paginate(10);
        $currency = DB::table('systemflag')->where('name', 'currencySymbol')->value('value') ?? '\u20b9';
        $pujari   = $user->pujariData;
        
        return view('frontend.pujari.my-bookings', compact('bookings', 'status', 'currency', 'pujari'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // MY REVIEWS (pujari portal)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function myReviews(Request $request)
    {
        $user = self::pujariAuthCheck();
        if (!$user) return redirect()->route('front.pujariLogin');

        $pujariId = $user->pujariId;

        $reviews = DB::table('pujari_reviews as pr')
            ->leftJoin('users', 'users.id', '=', 'pr.userId')
            ->where('pr.pujariId', $pujariId)
            ->select('pr.*', DB::raw("COALESCE(users.name, pr.user_name, 'Anonymous') as reviewerName"))
            ->orderByDesc('pr.id')
            ->paginate(10);

        $avgRating = DB::table('pujari_reviews')->where('pujariId', $pujariId)->avg('rating') ?? 0;
        $pujari    = $user->pujariData;

        return view('frontend.pujari.my-reviews', compact('reviews', 'avgRating', 'pujari'));
    }

    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500
    // EDIT PROFILE (pujari portal)
    // \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function editProfile(Request $request)
    {
        $user = self::pujariAuthCheck();
        if (!$user) return redirect()->route('front.pujariLogin');

        $pujari = $user->pujariData;

        return view('frontend.pujari.edit-profile', compact('pujari'));
    }

    public function updateProfile(Request $request)
    {
        $user = self::pujariAuthCheck();
        if (!$user) return redirect()->route('front.pujariLogin');

        try {
            $pujariId = $user->pujariId;
            $data = $request->only([
                'name', 'whatsappNo', 'loginBio', 'currentCity',
                'primarySkill', 'allSkill', 'languageKnown', 'experienceInYears',
                'instaProfileLink', 'facebookProfileLink', 'youtubeChannelLink',
                'bankName', 'bankBranch', 'accountNumber', 'ifscCode', 'accountType', 'upi',
            ]);

            if ($request->hasFile('profileImage')) {
                $file     = $request->file('profileImage');
                $filename = 'pujari_profile_' . time() . '.' . $file->getClientOriginalExtension();
                $dest     = 'public/storage/pujari_files';
                @mkdir(public_path($dest), 0755, true);
                $file->move(public_path($dest), $filename);
                $data['profileImage'] = $dest . '/' . $filename;
            }

            DB::table('pujaris')->where('id', $pujariId)->update($data);

            return response()->json(['status' => 200, 'message' => 'Profile updated successfully']);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}