<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'date',
        ];
    }

    public function messageType(): BelongsTo
    {
        return $this->belongsTo(MessageType::class);
    }
}
