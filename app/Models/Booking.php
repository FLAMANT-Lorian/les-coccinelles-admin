<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'hall_rate_id',
        'meter_reading_id',
        'company_name',
        'deposit_status',
        'prepayment',
        'message',
        'billing_address',
        'uniqid',
        'cleaning',
        'breaking'
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function hall_rate(): BelongsTo
    {
        return $this->belongsTo(HallRate::class);
    }

    public function meterReading(): HasOne
    {
        return $this->hasOne(MeterReading::class);
    }

    public function bookingDate(): HasOne
    {
        return $this->hasOne(BookingDate::class);
    }
}
