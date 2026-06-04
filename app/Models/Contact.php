<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'telephone',
        'member_card',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'member_card' => 'boolean',
        ];
    }

    /**
     * Get the user's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (ucfirst($this->first_name) ?? '') . ' ' . (ucfirst($this->last_name) ?? ''),
        );
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
