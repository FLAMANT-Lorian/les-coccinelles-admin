<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'date',
        'hour',
        'description',
        'file',
    ];

    public function casts(): array
    {
        return [
            'date' => 'date',
            'hour' => 'datetime'
        ];
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attendances');
    }
}
