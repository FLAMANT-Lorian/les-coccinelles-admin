<?php

namespace Database\Seeders;

use App\Models\HallRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HallRate::factory()
            ->count(3)
            ->create();
    }
}
