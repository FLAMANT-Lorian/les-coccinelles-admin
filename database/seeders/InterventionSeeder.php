<?php

namespace Database\Seeders;

use App\Models\Intervention;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class InterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::whereDoesntHave('roles', function (Builder $q) {
            $q->where('name', config('permission.super_admin_name'));
        })->first();

        Intervention::factory()
            ->createdBy($user)
            ->assignedTo($user)
            ->create();
    }
}
