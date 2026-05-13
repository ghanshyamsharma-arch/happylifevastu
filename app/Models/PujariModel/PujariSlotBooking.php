<?php

namespace App\Models\PujariModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PujariBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pujari_bookings';

    protected $fillable = [
        'pujariId', 'userId',
        'slotId',                              // \u2190 NEW: linked slot
        'bookingType', 'bookingDate', 'timeSlot', 'specialRequirement', 'location',
        'personName', 'personContact', 'personEmail', 'address',
        'pujaName', 'gotra', 'familyMemberNames',
        'amount', 'gstAmount', 'totalAmount',
        'paymentMode', 'paymentStatus', 'transactionId',
        'status', 'cancelReason', 'adminNote',
        'createdBy', 'modifiedBy',
    ];

    protected $casts = [
        'bookingDate' => 'datetime',
    ];

    public function pujari()
    {
        return $this->belongsTo(\App\Models\Pujari::class, 'pujariId');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'userId');
    }

    public function slot()
    {
        return $this->belongsTo(PujariSlot::class, 'slotId');
    }
}