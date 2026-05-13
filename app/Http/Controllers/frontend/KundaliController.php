<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserModel\Kundali;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Session\Session;

class KundaliController extends Controller
{
    public function getPanchang(Request $request)
    {
        Artisan::call('cache:clear');

        $panchangDate = $request->panchangDate ?: Carbon::now();

        $api_key = DB::table('systemflag')->where('name', 'vedicAstroAPI')->first();
        
        // SAFETY: Check if API key exists
        $apiKeyValue = $api_key->value ?? '';
        
        $ip = $request->ip();
        if ($ip === '127.0.0.1' || $ip === '::1' || !$ip) {
            $ip = '103.238.108.209';
        }

        $position = Location::get($ip);
        if (!$position) {
            $position = (object) [
                'latitude' => '28.6139',
                'longitude' => '77.2090',
                'cityName' => 'New Delhi',
                'regionName' => 'Delhi',
                'countryName' => 'India',
                'timezone' => 'Asia/Kolkata',
            ];
        }

        $geoData = [
            'ip' => $ip,
            'lat' => $position->latitude ?? '28.6139',
            'lon' => $position->longitude ?? '77.2090',
            'city' => $position->cityName ?? 'New Delhi',
            'region' => $position->regionName ?? 'Delhi',
            'country' => $position->countryName ?? 'India',
            'timezone' => $position->timezone ?? 'Asia/Kolkata',
        ];
        
        $latitude = $geoData['lat'];
        $longitude = $geoData['lon'];
        $timezone = $geoData['timezone'];

        $date = date('d/m/Y');
        if ($request->panchangDate) {
            $date = date('d/m/Y', strtotime($request->panchangDate));
        }

        // FIX: Ensure HH:MM format
        $time = Carbon::now($timezone)->format('H:i');

        $Todayspanchang = Http::get('https://api.vedicastroapi.com/v3-json/panchang/panchang', [
            'date' => $date,
            'time' => $time,
            'tz' => $this->getTimezoneOffset($timezone),
            'lat' => $latitude,
            'lon' => $longitude,
            'api_key' => $apiKeyValue,
            'lang' => 'en'
        ]);

        $getPanchang = $Todayspanchang->json();
        
        return view('frontend.pages.panchang', [
            'getPanchang' => $getPanchang ?? [],
        ]);
    }

    private function getTimezoneOffset($timezone)
    {
        try {
            $time = new \DateTime('now', new \DateTimeZone($timezone));
            return $time->getOffset() / 3600;
        } catch (\Exception $e) {
            return 5.5; // Default to IST
        }
    }

    public function getkundali(Request $request)
    {
        Artisan::call('cache:clear');

        $session = new Session();
        $token = $session->get('token');

        $getkundaliprice = [];
        $getkundali = [];
        $currency = ['value' => '$'];
        
        try {
            $getkundaliprice = Http::withoutVerifying()->post(url('/') . '/api/pdf/price', [
                'token' => $token,
            ])->json();
            
            $getkundaliprice = $getkundaliprice ?? [];
        } catch (\Exception $e) {
            \Log::error('Failed to fetch kundali price: ' . $e->getMessage());
        }
        
        try {
            $getkundali = Http::withoutVerifying()->post(url('/') . '/api/getkundali', [
                'token' => $token,
            ])->json();
            
            $getkundali = $getkundali ?? [];
        } catch (\Exception $e) {
            \Log::error('Failed to fetch kundali: ' . $e->getMessage());
        }

        try {
            $getsystemflag = Http::withoutVerifying()->post(url('/') . '/api/getSystemFlag', [
                'token' => $token,
            ])->json();
            
            if (isset($getsystemflag['recordList']) && is_array($getsystemflag['recordList'])) {
                $getsystemflag = collect($getsystemflag['recordList']);
                $currency = $getsystemflag->where('name', 'currencySymbol')->first();
                $currency = $currency ?? ['value' => '$'];
            }
        } catch (\Exception $e) {
            \Log::error('Failed to fetch system flags: ' . $e->getMessage());
            $currency = ['value' => '$'];
        }

        return view('frontend.pages.kundali', [
            'getkundali' => $getkundali,
            'getkundaliprice' => $getkundaliprice,
            'currency' => $currency,
        ]);
    }

    public function kundaliMatch(Request $request)
    {
        // Initialize session
        $session = new Session();
        $token = $session->get('token');
        
        // Set safe defaults
        $professionTitle = 'Astrologer';
        $appname = config('app.name', 'HappyLifeVastu');
        $googleApiKey = '';
        
        // Try to get profession title from system flags
        try {
            $getsystemflag = Http::withoutVerifying()
                ->post(url('/') . '/api/getSystemFlag', [
                    'token' => $token,
                ])->json();
            
            if (isset($getsystemflag['recordList']) && is_array($getsystemflag['recordList'])) {
                $systemFlags = collect($getsystemflag['recordList']);
                $professionFlag = $systemFlags->where('name', 'professionTitle')->first();
                $professionTitle = $professionFlag['value'] ?? 'Astrologer';
            }
        } catch (\Exception $e) {
            \Log::error('Failed to fetch profession title: ' . $e->getMessage());
        }
        
        // Get Google Maps API key from database
        try {
            $apiKeyRecord = DB::table('systemflag')
                ->where('name', 'googleMapApiKey')
                ->first();
            
            if ($apiKeyRecord && isset($apiKeyRecord->value)) {
                $googleApiKey = $apiKeyRecord->value;
            }
        } catch (\Exception $e) {
            \Log::error('Failed to get Google API key: ' . $e->getMessage());
        }
        
        // Return view with ALL required data
        return view('frontend.pages.kundali-matching', [
            'professionTitle' => $professionTitle,
            'appname' => $appname,
            'googleApiKey' => $googleApiKey,
        ]);
    }

    public function kundaliMatchReport(Request $request)
    {
        $KundaliMatching = [];
        $kundalimale = null;
        $kundalifemale = null;
        
        try {
            $KundaliMatching = Http::withoutVerifying()->post(url('/') . '/api/KundaliMatching/report', [
                'male_kundli_id' => $request->male_kundli_id,
                'female_kundli_id' => $request->female_kundli_id,
            ])->json();
            
            $KundaliMatching = $KundaliMatching ?? [];
        } catch (\Exception $e) {
            \Log::error('Failed to fetch kundali matching report: ' . $e->getMessage());
        }
        
        try {
            $kundalimale = Kundali::where('id', $request->male_kundli_id)->first();
            $kundalifemale = Kundali::where('id', $request->female_kundli_id)->first();
        } catch (\Exception $e) {
            \Log::error('Failed to fetch kundali records: ' . $e->getMessage());
        }

        return view('frontend.pages.kundali-match-report', [
            'KundaliMatching' => $KundaliMatching,
            'kundalimale' => $kundalimale,
            'kundalifemale' => $kundalifemale,
        ]);
    }

    public function kundaliReport(Request $request)
    {
        // Initialize session
        $session = new Session();
        $sessionKey = 'kundali_report_' . ($request->kundali_id ?? '') . '_' . ($request->lang ?? 'en');
        
        $KundaliReport = [];
        
        try {
            if ($session->has($sessionKey)) {
                $KundaliReport = $session->get($sessionKey);
            } else {
                // Make API call if not in session
                $KundaliReport = Http::withoutVerifying()->post(url('/') . '/api/kundali/getKundaliReport', [
                    'kundali_id' => $request->kundali_id,
                    'lang' => $request->lang
                ])->json();
                
                $KundaliReport = $KundaliReport ?? [];
                
                // Store in session for subsequent requests
                if (!empty($KundaliReport)) {
                    $session->set($sessionKey, $KundaliReport);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Failed to fetch kundali report: ' . $e->getMessage());
        }

        return view('frontend.pages.kundali-report', compact('KundaliReport'));
    }
}