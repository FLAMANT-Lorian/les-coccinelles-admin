<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\MeterReading;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::factory(20)
            ->has(MeterReading::factory())
            ->create();
    }
}
