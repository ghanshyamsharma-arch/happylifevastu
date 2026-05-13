<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Puja extends Model
{
    use HasFactory;

    protected $table = 'pujas';

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'puja_title',
        'puja_subtitle',
        'puja_place',
        'long_description',
        'puja_benefits',
        'puja_images',
        'package_id',
        'puja_start_datetime',
        'puja_end_datetime',
        'slug',
        'astrologerId',
        'pujariId',          // \u2190 NEW
        'created_by',        // 'admin' | 'astrologer' | 'pujari'
        'puja_price',
        'isAdminApproved',
        'puja_duration',
        'isPujaEnded',
        'actual_puja_endtime',
    ];

    protected $casts = [
        'puja_benefits' => 'array',
        'puja_images'   => 'array',
        'package_id'    => 'array',
    ];

    // \u2500\u2500 Relations \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function package()
    {
        return Pujapackage::whereIn('id', $this->package_id ?? [])->get();
    }

    public function singlepackage($id)
    {
        return Pujapackage::where('id', $id)->first();
    }

    public function pujari()
    {
        return $this->belongsTo(\App\Models\Pujari::class, 'pujariId');
    }

    public function astrologer()
    {
        return $this->belongsTo(\App\Models\AstrologerModel\Astrologer::class, 'astrologerId');
    }

    public function astrologerRelation()
    {
        return $this->belongsTo(\App\Models\AstrologerModel\Astrologer::class, 'astrologerId');
    }

    public function category()
    {
        return $this->hasOne(PujaCategory::class, 'id', 'category_id');
    }

    // \u2500\u2500 Accessor: always return full URLs for images \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500

    public function getPujaImagesAttribute($value): array
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (empty($value) || !is_array($value)) {
            return [];
        }

        return array_map(function ($imagePath) {
            if (Str::startsWith($imagePath, ['http://', 'https://'])) {
                return $imagePath;
            }
            return asset($imagePath);
        }, $value);
    }
}