<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembersRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'unique',
    ];

    protected function casts(): array
    {
        return [
            'unique' => 'boolean',
        ];
    }
}
