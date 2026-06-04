<?php

namespace App\Models;

use App\Observers\MeetingObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(MeetingObserver::class)]
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
        ];
    }
}
