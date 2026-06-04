<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\BookingDate;
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
        $contact = Contact::first();
        $type = HallRate::first();

            Booking::factory()
                ->contact($contact)
                ->type($type)
                ->has(BookingDate::factory())
                ->has(MeterReading::factory())
                ->create();
    }
}
