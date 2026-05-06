<?php

namespace Database\Seeders;

use App\Models\AvailabilityRequest;
use App\Models\HallRate;
use App\Models\Message;
use App\Models\User;
use App\Models\UtilityCost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        ]);
    }
}
