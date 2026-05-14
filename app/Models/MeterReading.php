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
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
