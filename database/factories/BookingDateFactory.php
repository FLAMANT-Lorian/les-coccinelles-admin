<?php

namespace Database\Factories;

use App\Models\BookingDate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingDateFactory extends Factory
{
    protected $model = BookingDate::class;

    public function definition(): array
    {
        return [
            'key_handover_date' => Carbon::now()->subDays(3),
            'key_handover_hour' => Carbon::now()->format('H:i:s'),
            'key_return_date' => Carbon::now()->subDay(),
            'key_return_hour' => Carbon::now()->format('H:i:s'),
            'start_date' => Carbon::now()->subDays(3),
            'end_date' => Carbon::now()->subDay(),
        ];
    }
}
