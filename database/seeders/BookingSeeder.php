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
        for ($i = 0; $i < 10; $i++) {
            Booking::factory()
                ->contact(Contact::factory()->create())
                ->type(HallRate::factory()->create())
                ->has(MeterReading::factory())
                ->create();
        }
    }
}
