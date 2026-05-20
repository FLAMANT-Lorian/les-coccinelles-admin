<?php

namespace Database\Seeders;

use App\Models\Intervention;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class InterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::first();

        $role = Role::where('unique', 0)->first();
        $user2 = User::factory()->create();
        $user2->assignRole($role);

        Intervention::factory()
            ->createdBy($user1)
            ->assignedTo($user2)
            ->create();
    }
}
