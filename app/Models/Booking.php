<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'hall_rate_id',
        'status',
        'key_handover_date',
        'key_return_date',
        'start_date',
        'end_date',
        'message',
        'billing_address'
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function hall_rate(): BelongsTo
    {
        return $this->belongsTo(HallRate::class, 'hall_rate_id');
    }
}
