<?php

namespace App\Models\PujariModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pujari extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pujaris';

    protected $fillable = [
        'userId', 'name', 'slug', 'email', 'countryCode', 'contactNo', 'whatsappNo',
        'aadharNo', 'pancardNo', 'gender', 'birthDate', 'primarySkill', 'allSkill',
        'languageKnown', 'profileImage', 'astro_video', 'experienceInYears', 'loginBio',
        'currentCity', 'mainSourceOfBusiness', 'highestQualification', 'degree', 'college',
        'learnAstrology', 'pujariCategoryId', 'instaProfileLink', 'facebookProfileLink',
        'linkedInProfileLink', 'youtubeChannelLink', 'websiteProfileLink',
        'isAnyBodyRefer', 'minimumEarning', 'maximumEarning', 'nameofplateform',
        'monthlyEarning', 'referedPerson', 'hearAboutUs', 'whyOnBoard',
        'interviewSuitableTime', 'isWorkingOnAnotherPlatform', 'goodQuality',
        'biggestChallenge', 'whatwillDo',
        'reportRate', 'reportRate_usd',
        'isVerified', 'isActive', 'isDelete', 'totalOrder', 'country',
        'ifscCode', 'bankName', 'bankBranch', 'accountType', 'accountNumber',
        'accountHolderName', 'upi', 'aadhar_card', 'pan_card', 'certificate',
        'createdBy', 'modifiedBy',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'userId');
    }

    public function reviews()
    {
        return $this->hasMany(PujariReview::class, 'pujariId');
    }

    public function bookings()
    {
        return $this->hasMany(PujariBooking::class, 'pujariId');
    }

    public function blockedBy()
    {
        return $this->hasMany(BlockPujari::class, 'pujariId');
    }

    // ── Computed attributes ────────────────────────────────────────────────────

    public function getAvgRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }
}