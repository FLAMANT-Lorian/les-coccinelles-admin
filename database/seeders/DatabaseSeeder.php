<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            MessageSeeder::class,
            AvailabilitySeeder::class,
            HallRateSeeder::class,
            UtilityCostSeeder::class,
            InterventionSeeder::class,
            ContactSeeder::class,
            BookingSeeder::class,
            MeetingSeeder::class,
            EventSeeder::class
        ]);
    }
}
