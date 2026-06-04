<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Booking */
class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'start_date' => $this->bookingDate->start_date->format('Y-m-d'),
            'end_date' => $this->bookingDate->end_date->format('Y-m-d'),
        ];
    }
}
