<?php

namespace App\Models;

use  Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;

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
        'notifications',
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
            'notifications' => 'array',
            'birth_date' => 'date'
        ];
    }

    public function createdInterventions(): HasMany
    {
        return $this->hasMany(Intervention::class, 'created_by');
    }

    public function assignedInterventions(): HasMany
    {
        return $this->hasMany(Intervention::class, 'assigned_to');
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
