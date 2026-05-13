<?php

namespace App\Models\PujariModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PujariReview extends Model
{
    use HasFactory;

    protected $table = 'pujari_reviews';

    protected $fillable = [
        'pujariId', 'userId', 'user_name',
        'rating', 'comment', 'isPublic',
        'createdBy', 'modifiedBy',
    ];

    public function pujari()
    {
        return $this->belongsTo(Pujari::class, 'pujariId');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'userId');
    }
}