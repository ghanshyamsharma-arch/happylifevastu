<?php

namespace App\Models\PujariModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockPujari extends Model
{
    use HasFactory;

    protected $table = 'block_pujari';

    protected $fillable = [
        'pujariId', 'userId', 'reason',
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