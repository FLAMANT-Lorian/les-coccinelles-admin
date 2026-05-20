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
            ->create([
                'type' => 'Membre du comité',
                'base_price' => 0,
                'member_price' => 0,
                'deposit' => 0
            ]);

        HallRate::factory()
            ->create([
                'type' => 'Basique',
                'base_price' => 29000,
                'member_price' => 22500,
                'deposit' => 25000
            ]);

        HallRate::factory()
            ->create([
                'type' => 'Réunion privée sans vente de boissons',
                'base_price' => 12500,
                'member_price' => 12500,
                'deposit' => 25000
            ]);

        HallRate::factory()
            ->create([
                'type' => 'Évenement public avec vente de boissons',
                'base_price' => 29000,
                'member_price' => 22500,
                'deposit' => 50000
            ]);

        HallRate::factory()
            ->create([
                'type' => 'Enterrement',
                'base_price' => 15000,
                'member_price' => 10000,
                'deposit' => 0
            ]);
    }
}
