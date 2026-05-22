<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeterReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'before_water_general',
        'after_water_general',
        'before_water_cdj',
        'after_water_cdj',
        'before_electricity_general',
        'after_electricity_general',
        'before_electricity_cdj',
        'after_electricity_cdj',
        'before_mazout_general',
        'after_mazout_general',
        'booking_id',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function canGenerateInvoice(): bool
    {
        if ($this->before_mazout_general &&
            $this->after_water_general &&
            $this->before_water_cdj &&
            $this->after_water_cdj &&
            $this->before_electricity_general &&
            $this->after_electricity_general &&
            $this->before_electricity_cdj &&
            $this->after_electricity_cdj &&
            $this->before_mazout_general &&
            $this->after_mazout_general
        ) {
            return true;
        } else {
            return false;
        }
    }
}
