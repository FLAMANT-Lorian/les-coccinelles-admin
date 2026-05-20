<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HallRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'base_price',
        'member_price',
        'deposit',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
