<?php

namespace Database\Seeders;

use App\Models\AvailabilityRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AvailabilityRequest::factory()
            ->count(30)
            ->create();
    }
}
