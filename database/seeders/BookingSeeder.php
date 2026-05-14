<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::factory(10)
            ->contact(Contact::factory()->create())
            ->type(HallRate::factory()->create())
            ->has(MeterReading::factory())
            ->create();
    }
}
