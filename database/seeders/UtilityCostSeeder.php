<?php

namespace Database\Seeders;

use App\Enums\UtilityCostsStatus;
use App\Models\UtilityCost;
use Illuminate\Database\Seeder;

class UtilityCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // EAU
        UtilityCost::factory()
            ->create([
                'type' => 'Eau',
                'price' => 0,
                'status' => UtilityCostsStatus::outOfDate->value,
                'unit' => 'm3'
            ]);

        // ÉLECTRICITÉ
        UtilityCost::factory()
            ->create([
                'type' => 'Électricité',
                'price' => 0,
                'status' => UtilityCostsStatus::outOfDate->value,
                'unit' => 'kWh'
            ]);

        // MAZOUT
        UtilityCost::factory()
            ->create([
                'type' => 'Mazout',
                'price' => 0,
                'status' => UtilityCostsStatus::outOfDate->value,
                'unit' => 'unité'
            ]);
    }
}
