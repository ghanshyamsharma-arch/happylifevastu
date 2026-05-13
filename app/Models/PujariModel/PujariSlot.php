<?php

namespace App\Models\PujariModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PujariSlot extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pujari_slots';

   protected $fillable = [
    'pujariId',
    'dayType',

    // specific date slot
    'slotDate',
    'specificDate',

    // recurring slot
    'dayOfWeek',

    'startTime',
    'endTime',

    'rate',
    'maxBookings',

    'note',

    'status',
    'is_active',

    'createdBy',
    'modifiedBy',
];
    protected $casts = [
        'slotDate' => 'date',
    ];

    // Day name helper
    public function getDayNameAttribute(): string
    {
        $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        return $this->dayType === 'recurring'
            ? ($days[$this->dayOfWeek] ?? '')
            : ($this->slotDate ? $this->slotDate->format('d M Y') : '');
    }

    // Is slot available?
    public function getIsAvailableAttribute(): bool
    {
        return $this->status === 'active' && $this->bookedCount < $this->maxBookings;
    }

    public function pujari()
    {
        return $this->belongsTo(\App\Models\Pujari::class, 'pujariId');
    }

    public function bookings()
    {
        return $this->hasMany(PujariBooking::class, 'slotId');
    }
}