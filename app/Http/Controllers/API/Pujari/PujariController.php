<?php

namespace App\Http\Controllers\API\Pujari;

use App\Http\Controllers\Controller;
use App\Models\PujariModel\Pujari;
use App\Models\UserModel\UserRole;
use App\Models\User as BaseUser;
use App\Models\User;
use App\Models\EmailTemplate;
use App\Helpers\StorageHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

class PujariController extends Controller
{
    // ── Register new pujari ───────────────────────────────────────────────────
    public function addPujari(Request $req)
    {
        try {
            DB::beginTransaction();

            $data = $req->only(
                'name', 'email', 'contactNo', 'gender', 'birthDate',
                'primarySkill', 'allSkill', 'languageKnown', 'reportRate',
                'experienceInYears', 'isWorkingOnAnotherPlatform', 'whyOnBoard',
                'interviewSuitableTime', 'mainSourceOfBusiness', 'highestQualification',
                'degree', 'college', 'learnAstrology', 'pujariCategoryId',
                'instaProfileLink', 'facebookProfileLink', 'linkedInProfileLink',
                'youtubeChannelLink', 'websiteProfileLink', 'isAnyBodyRefer',
                'minimumEarning', 'maximumEarning', 'loginBio',
                'hearAboutUs', 'goodQuality', 'biggestChallenge', 'whatwillDo',
                'whatsappNo', 'pancardNo', 'aadharNo',
                'ifscCode', 'bankBranch', 'bankName', 'accountType', 'accountNumber', 'upi',
            );

            $validator = Validator::make($data, [
                'name'                 => 'required|string',
                'email'                => 'required|unique:users,email',
                'contactNo'            => 'required|max:10|unique:users,contactNo',
                'gender'               => 'required',
                'birthDate'            => 'required',
                'languageKnown'        => 'required',
                'primarySkill'         => 'required',
                'allSkill'             => 'required',
                'experienceInYears'    => 'required',
                'highestQualification' => 'required',
                'whatsappNo'           => 'required',
                'aadharNo'             => 'required',
                'pancardNo'            => 'required',
                'reportRate'           => 'required',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return response()->json(['error' => $validator->messages(), 'status' => 400], 400);
            }

            $countryCode = !empty($req->countryCode) ? $req->countryCode : '+91';

            // Create user account
            $user = User::create([
                'name'        => $req->name,
                'contactNo'   => $req->contactNo,
                'email'       => $req->email,
                'birthDate'   => $req->birthDate,
                'gender'      => $req->gender,
                'location'    => $req->currentCity,
                'countryCode' => $countryCode,
                'country'     => $countryCode == '+91' ? 'india' : ($req->country ?? 'international'),
            ]);

            $referral_token = 'REF' . numberToCharacterString($user->id);
            $user->update(['referral_token' => $referral_token]);

            // Unique slug
            $slug = Str::slug($req->name, '-');
            $originalSlug = $slug;
            $counter = 1;
            while (DB::table('pujaris')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            // Create pujari record
            $pujari = Pujari::create([
                'name'                       => $req->name,
                'slug'                       => $slug,
                'userId'                     => $user->id,
                'email'                      => $req->email,
                'contactNo'                  => $req->contactNo,
                'countryCode'                => $countryCode,
                'country'                    => $countryCode == '+91' ? 'india' : ($req->country ?? 'international'),
                'gender'                     => $req->gender,
                'birthDate'                  => $req->birthDate,
                'primarySkill'               => implode(',', array_column($req->primarySkill, 'id')),
                'allSkill'                   => implode(',', array_column($req->allSkill, 'id')),
                'languageKnown'              => implode(',', array_column($req->languageKnown, 'id')),
                'experienceInYears'          => $req->experienceInYears,
                'hearAboutUs'                => $req->hearAboutUs,
                'isWorkingOnAnotherPlatform' => $req->isWorkingOnAnotherPlatform,
                'whyOnBoard'                 => $req->whyOnBoard,
                'interviewSuitableTime'      => $req->interviewSuitableTime,
                'currentCity'                => $req->currentCity,
                'mainSourceOfBusiness'       => $req->mainSourceOfBusiness,
                'highestQualification'       => $req->highestQualification,
                'degree'                     => $req->degree,
                'college'                    => $req->college,
                'learnAstrology'             => $req->learnAstrology,
                'pujariCategoryId'           => is_array($req->pujariCategoryId)
                                                ? implode(',', array_column($req->pujariCategoryId, 'id'))
                                                : $req->pujariCategoryId,
                'instaProfileLink'           => $req->instaProfileLink,
                'linkedInProfileLink'        => $req->linkedInProfileLink,
                'facebookProfileLink'        => $req->facebookProfileLink,
                'websiteProfileLink'         => $req->websiteProfileLink,
                'youtubeChannelLink'         => $req->youtubeChannelLink,
                'isAnyBodyRefer'             => $req->isAnyBodyRefer,
                'minimumEarning'             => $req->minimumEarning,
                'maximumEarning'             => $req->maximumEarning,
                'loginBio'                   => $req->loginBio,
                'goodQuality'                => $req->goodQuality,
                'biggestChallenge'           => $req->biggestChallenge,
                'whatwillDo'                 => $req->whatwillDo,
                'isVerified'                 => false,
                'reportRate'                 => $req->reportRate ?? 0,
                'reportRate_usd'             => $req->reportRate_usd,
                'nameofplateform'            => $req->nameofplateform,
                'monthlyEarning'             => $req->monthlyEarning,
                'referedPerson'              => $req->referedPerson,
                'whatsappNo'                 => $req->whatsappNo,
                'aadharNo'                   => $req->aadharNo,
                'pancardNo'                  => $req->pancardNo,
                'ifscCode'                   => $req->ifscCode,
                'bankBranch'                 => $req->bankBranch,
                'accountType'                => $req->accountType,
                'bankName'                   => $req->bankName,
                'accountNumber'              => $req->accountNumber,
                'accountHolderName'          => $req->accountHolderName,
                'upi'                        => $req->upi,
                'createdBy'                  => $user->id,
                'modifiedBy'                 => $user->id,
            ]);

            // Profile image (base64)
            if ($req->profileImage) {
                $time   = Carbon::now()->timestamp;
                $path   = 'public/storage/images/pujari_' . $user->id . $time . '.png';
                file_put_contents($path, base64_decode($req->profileImage));
                $user->profile        = $path;
                $pujari->profileImage = $path;
                $user->update();
                $pujari->update();
            }

            // Assign role = 2 (same as astrologer app login)
            UserRole::create(['userId' => $user->id, 'roleId' => 2]);

            // Welcome email
            $template = EmailTemplate::where('name', 'partner_registration')->first();
            if ($template) {
                $logo = DB::table('systemflag')->where('name', 'AdminLogo')->select('value')->first();
                $body = str_replace(
                    ['{{$username}}', '{{$logo}}'],
                    [$pujari->name, asset($logo->value ?? '')],
                    $template->description
                );
                $body = html_entity_decode($body);
                Mail::send([], [], function ($message) use ($pujari, $template, $body) {
                    $message->to($pujari->email)->subject($template->subject)->html($body);
                });
            }

            $this->resolveSkillsAndLanguages($pujari);

            DB::commit();
            return response()->json([
                'message'    => 'Pujari registered successfully',
                'recordList' => $pujari,
                'status'     => 200,
            ], 200);

        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => false, 'message' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // ── Login pujari ──────────────────────────────────────────────────────────
    public function loginPujari(Request $req)
{
    try {

        $dummyPassword = 'dummy@123';

        // =========================
        // FIND EXISTING PUJARI
        // =========================

        if ($req->contactNo) {

            $pujari = DB::table('pujaris')
                ->join('user_roles', 'pujaris.userId', '=', 'user_roles.userId')
                ->where('contactNo', $req->contactNo)
                ->where('user_roles.roleId', 2)
                ->where('pujaris.isDelete', false)
                ->select('pujaris.*')
                ->first();

        } elseif ($req->email) {

            $pujari = DB::table('pujaris')
                ->join('user_roles', 'pujaris.userId', '=', 'user_roles.userId')
                ->where('email', $req->email)
                ->where('user_roles.roleId', 2)
                ->where('pujaris.isDelete', false)
                ->select('pujaris.*')
                ->first();

        } else {

            return response()->json([
                'status' => 400,
                'message' => 'contactNo or email required'
            ], 400);
        }

        // =========================
        // CREATE NEW PUJARI
        // =========================

        if (!$pujari) {

            DB::beginTransaction();

            // CREATE USER
            $user = new BaseUser();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->contactNo = $req->phone;
            $user->password = Hash::make($dummyPassword);
            $user->save();

            // CREATE USER ROLE
            DB::table('user_roles')->insert([
                'userId' => $user->id,
                'roleId' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

           // CREATE PUJARI
            $slug = Str::slug($req->name . '-' . time());
            
            $pujariId = DB::table('pujaris')->insertGetId([
            
                'userId' => $user->id,
            
                'name' => $req->name,
                'slug' => $slug,
            
                'email' => $req->email,
                'contactNo' => $req->phone,
            
                'experienceInYears' => $req->experience,
                'currentCity' => $req->city,
                'primarySkill' => $req->specialization,
                'loginBio' => $req->bio,
            
                'otp' => $req->otp,
            
                // DEFAULT VALUES
                'isVerified' => 0, // ADMIN APPROVAL PENDING
                'isActive' => 1,
                'isDelete' => 0,
            
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $pujari = DB::table('pujaris')
                ->where('id', $pujariId)
                ->first();

            DB::commit();

        } else {

            // EXISTING USER
            $user = BaseUser::where('id', $pujari->userId)->first();

            if ($user && !$user->password) {
                $user->password = Hash::make($dummyPassword);
                $user->save();
            }
        }

        // =========================
        // VERIFIED CHECK
        // =========================

        if (!$pujari->isVerified) {

            return response()->json([
                'status' => 400,
                'message' => 'Account created successfully. Please wait for account verification.'
            ], 400);
        }

        // =========================
        // LOGIN
        // =========================

        if (!$token = Auth::guard('api')->tokenById($user->id)) {

            return response()->json([
                'status' => 401,
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $this->resolveSkillsAndLanguages($pujari);
        $this->convertImageFields($pujari);

        return response()->json([
            'success'    => true,
            'token'      => $token,
            'token_type' => 'Bearer',
            'status'     => 200,
            'recordList' => [$pujari],
        ], 200);

    } catch (Exception $e) {

        DB::rollBack();

        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}

    // ── Get all pujaris ───────────────────────────────────────────────────────
    public function getPujari(Request $req)
    {
        try {
            $pujaris = DB::table('pujaris')
                ->where('isDelete', 0)
                ->where('isVerified', 1)
                ->where('isActive', 1)
                ->when($req->search, fn($q) =>
                    $q->where('name', 'LIKE', '%' . $req->search . '%')
                      ->orWhere('primarySkill', 'LIKE', '%' . $req->search . '%')
                )
                ->orderBy('id', 'DESC')
                ->paginate(10);

            $items = collect($pujaris->items())->map(function ($p) {
                $this->resolveSkillsAndLanguages($p);
                $p->profileImage = $this->toAsset($p->profileImage ?? '');
                return $p;
            });

            return response()->json([
                'status'      => 200,
                'recordList'  => $items,
                'totalCount'  => $pujaris->total(),
                'currentPage' => $pujaris->currentPage(),
                'lastPage'    => $pujaris->lastPage(),
            ]);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'error' => $e->getMessage()]);
        }
    }

    // ── Get pujari by ID ──────────────────────────────────────────────────────
    public function getPujariById(Request $req)
    {
        // Intentionally no try-catch wrapper like original getAstrologerById
        $validator = Validator::make($req->all(), ['pujariId' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages(), 'status' => 400], 400);
        }

        $pujari = Pujari::where('id', $req->pujariId)->get();

        if (count($pujari) == 0) {
            return response()->json(['message' => 'No Pujari Found', 'status' => 400], 400);
        }

        $this->resolveSkillsAndLanguages($pujari[0]);

        // Convert image fields
        $this->convertImageFields($pujari[0]);

        // Reviews
        $review = DB::table('user_reviews as ur')
            ->leftJoin('users as us', 'us.id', '=', 'ur.userId')
            ->where('ur.astrologerId', $req->pujariId)   // reviews stored with astrologerId column
            ->select('ur.*', 'us.profile', DB::raw('IFNULL(us.name, ur.user_name) as userName'))
            ->orderBy('ur.id', 'DESC')
            ->get();

        foreach ($review as $rv) {
            $rv->profile = $this->toAsset($rv->profile ?? '');
        }

        // Wallet
        $wallet = DB::table('wallettransaction')
            ->where('userId', $pujari[0]->userId)
            ->orderBy('id', 'DESC')
            ->get();

        // Puja orders
        $pujaOrder = DB::table('puja_orders as po')
            ->leftJoin('puja_package as pp', 'pp.id', '=', 'po.package_id')
            ->leftJoin('pujas as pu', 'pu.id', '=', 'po.puja_id')
            ->where('po.astrologer_id', $req->pujariId)
            ->select('po.*', 'pp.description', 'pp.title', 'pu.puja_images')
            ->orderBy('po.id', 'DESC')
            ->get();

        // Rating calculation
        $one = $two = $three = $four = $five = 0;
        foreach ($review as $r) {
            ${['one', 'two', 'three', 'four', 'five'][$r->rating - 1]}++;
        }
        $total  = count($review);
        $rating = [
            'oneStarRating'   => $total ? $one * 100 / $total : 0,
            'twoStarRating'   => $total ? $two * 100 / $total : 0,
            'threeStarRating' => $total ? $three * 100 / $total : 0,
            'fourStarRating'  => $total ? $four * 100 / $total : 0,
            'fiveStarRating'  => $total ? $five * 100 / $total : 0,
        ];
        $avg = $total ? ($one + 2*$two + 3*$three + 4*$four + 5*$five) / $total : 0;

        $pujari[0]->review       = $review;
        $pujari[0]->wallet       = $wallet;
        $pujari[0]->pujaOrder    = $pujaOrder;
        $pujari[0]->rating       = $avg;
        $pujari[0]->ratingcount  = $total;
        $pujari[0]->pujariRating = $rating;

        // ── NOT included (intentionally removed for pujari) ──
        // chatHistory, callHistory, chatMin, callMin, call_method

        return response()->json([
            'message'    => 'Pujari Profile',
            'recordList' => $pujari,
            'status'     => 200,
        ], 200);
    }

    // ── Update pujari ─────────────────────────────────────────────────────────
    public function updatePujari(Request $req)
    {
        try {
            $user   = User::find($req->userId);
            $pujari = Pujari::find($req->id);

            if (!$pujari) {
                return response()->json(['message' => 'Pujari not found', 'status' => 404], 404);
            }

            $validator = Validator::make($req->all(), [
                'id'                   => 'required',
                'userId'               => 'required',
                'name'                 => 'required|string',
                'contactNo'            => 'required|unique:users,contactNo,' . $user->id,
                'email'                => 'required|email|unique:users,email,' . $user->id,
                'gender'               => 'required',
                'languageKnown'        => 'required',
                'primarySkill'         => 'required',
                'allSkill'             => 'required',
                'highestQualification' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages(), 'status' => 400], 400);
            }

            $time = now()->timestamp;
            $path = $user->profile ?? null;

            if ($req->hasFile('profileImage')) {
                $file      = $req->file('profileImage');
                $imageName = 'pujari_' . $user->id . '_' . $time . '.' . $file->getClientOriginalExtension();
                $path      = StorageHelper::uploadToActiveStorage(file_get_contents($file->getRealPath()), $imageName, 'profile');
            } elseif ($req->profileImage && !Str::contains($req->profileImage, 'storage')) {
                $imageName = 'pujari_' . $user->id . '_' . $time . '.png';
                $path      = StorageHelper::uploadToActiveStorage(base64_decode($req->profileImage), $imageName, 'profile');
            }

            // Update user
            if ($user) {
                $user->name        = $req->name;
                $user->contactNo   = $req->contactNo;
                $user->email       = $req->email;
                $user->birthDate   = $req->birthDate;
                $user->profile     = $path;
                $user->gender      = $req->gender;
                $user->location    = $req->currentCity;
                $user->countryCode = $req->countryCode ?? $user->countryCode;
                $user->update();
            }

            // Unique slug
            $slug = Str::slug($req->name, '-');
            $originalSlug = $slug;
            $counter = 1;
            while (DB::table('pujaris')->where('slug', $slug)->where('id', '!=', $req->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $pujari->name                       = $req->name;
            $pujari->slug                       = $slug;
            $pujari->email                      = $req->email;
            $pujari->contactNo                  = $req->contactNo;
            $pujari->gender                     = $req->gender;
            $pujari->birthDate                  = $req->birthDate;
            $pujari->primarySkill               = implode(',', array_column($req->primarySkill, 'id'));
            $pujari->allSkill                   = implode(',', array_column($req->allSkill, 'id'));
            $pujari->languageKnown              = implode(',', array_column($req->languageKnown, 'id'));
            $pujari->profileImage               = $path;
            $pujari->experienceInYears          = $req->experienceInYears;
            $pujari->hearAboutUs                = $req->hearAboutUs;
            $pujari->isWorkingOnAnotherPlatform = $req->isWorkingOnAnotherPlatform;
            $pujari->whyOnBoard                 = $req->whyOnBoard;
            $pujari->interviewSuitableTime      = $req->interviewSuitableTime;
            $pujari->currentCity                = $req->currentCity;
            $pujari->mainSourceOfBusiness       = $req->mainSourceOfBusiness;
            $pujari->highestQualification       = $req->highestQualification;
            $pujari->degree                     = $req->degree;
            $pujari->college                    = $req->college;
            $pujari->learnAstrology             = $req->learnAstrology;
            $pujari->pujariCategoryId           = is_array($req->pujariCategoryId)
                                                    ? implode(',', array_column($req->pujariCategoryId, 'id'))
                                                    : $req->pujariCategoryId;
            $pujari->instaProfileLink           = $req->instaProfileLink;
            $pujari->linkedInProfileLink        = $req->linkedInProfileLink;
            $pujari->facebookProfileLink        = $req->facebookProfileLink;
            $pujari->websiteProfileLink         = $req->websiteProfileLink;
            $pujari->youtubeChannelLink         = $req->youtubeChannelLink;
            $pujari->isAnyBodyRefer             = $req->isAnyBodyRefer;
            $pujari->minimumEarning             = $req->minimumEarning;
            $pujari->maximumEarning             = $req->maximumEarning;
            $pujari->loginBio                   = $req->loginBio;
            $pujari->goodQuality                = $req->goodQuality;
            $pujari->biggestChallenge           = $req->biggestChallenge;
            $pujari->whatwillDo                 = $req->whatwillDo;
            $pujari->reportRate                 = $req->reportRate ?? 0;
            $pujari->reportRate_usd             = $req->reportRate_usd;
            $pujari->nameofplateform            = $req->nameofplateform;
            $pujari->monthlyEarning             = $req->monthlyEarning;
            $pujari->referedPerson              = $req->referedPerson;
            $pujari->whatsappNo                 = $req->whatsappNo;
            $pujari->aadharNo                   = $req->aadharNo;
            $pujari->pancardNo                  = $req->pancardNo;
            $pujari->ifscCode                   = $req->ifscCode;
            $pujari->accountType                = $req->accountType;
            $pujari->bankBranch                 = $req->bankBranch;
            $pujari->bankName                   = $req->bankName;
            $pujari->accountNumber              = $req->accountNumber;
            $pujari->accountHolderName          = $req->accountHolderName;
            $pujari->upi                        = $req->upi;
            $pujari->update();

            $this->resolveSkillsAndLanguages($pujari);

            return response()->json([
                'message'    => 'Pujari updated successfully',
                'recordList' => $pujari,
                'status'     => 200,
            ], 200);

        } catch (Exception $e) {
            return response()->json(['error' => false, 'message' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // ── Delete pujari ─────────────────────────────────────────────────────────
    public function deletePujari(Request $req)
    {
        try {
            Pujari::where('id', $req->id)->update(['isDelete' => 1]);
            return response()->json(['message' => 'Pujari deleted successfully', 'status' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['error' => false, 'message' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    // ── Private helpers ───────────────────────────────────────────────────────
    private function resolveSkillsAndLanguages(&$pujari)
    {
        if (empty($pujari->allSkill)) return;

        $allSkillIds     = array_map('intval', explode(',', $pujari->allSkill));
        $primarySkillIds = array_map('intval', explode(',', $pujari->primarySkill));
        $languageIds     = array_map('intval', explode(',', $pujari->languageKnown));

        $pujari->allSkill      = DB::table('skills')->whereIn('id', $allSkillIds)->select('name', 'id')->get();
        $pujari->primarySkill  = DB::table('skills')->whereIn('id', $primarySkillIds)->select('name', 'id')->get();
        $pujari->languageKnown = DB::table('languages')->whereIn('id', $languageIds)->select('languageName', 'id')->get();
    }

    private function convertImageFields(&$pujari)
    {
        $fields = ['profileImage', 'aadhar_card', 'pan_card', 'certificate', 'astro_video'];
        foreach ($fields as $field) {
            if (isset($pujari->$field)) {
                $pujari->$field = $this->toAsset($pujari->$field);
            }
        }
    }

    private function toAsset(?string $value): ?string
    {
        if (empty($value)) return null;
        if (Str::startsWith($value, ['http://', 'https://'])) return $value;
        return asset($value);
    }
}