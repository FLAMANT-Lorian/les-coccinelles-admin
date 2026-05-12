<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'contact_id' => Contact::factory()->create()->id,
            'hall_rate_id' => HallRate::factory()->create()->id,
            'meter_reading_id' => MeterReading::factory()->create()->id,
            'status' => $faker->randomElement(enumToArray(BookingStatus::class)),
            'key_handover_date' => Carbon::now()->subDays(rand(2, 10)),
            'key_return_date' => Carbon::now()->subDays(rand(2, 10)),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(3),
            'message' => $faker->realText(100),
            'billing_address' => $faker->address
        ];
    }
}
