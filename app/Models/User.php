<?php

namespace App\Models;

use  Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'birth_date',
        'sex',
        'city',
        'postal_code',
        'address',
        'status',
        'avatar_path',
        'documents',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'documents' => 'array',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
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
}
