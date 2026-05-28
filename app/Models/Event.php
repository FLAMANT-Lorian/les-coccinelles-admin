<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'address',
        'description',
        'google_drive_url'
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
