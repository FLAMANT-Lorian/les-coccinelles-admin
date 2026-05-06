<?php

namespace Database\Seeders;

use App\Models\UtilityCost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilityCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UtilityCost::factory()
            ->count(3)
            ->create();
    }
}
