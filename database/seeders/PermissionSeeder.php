<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'messages' => [
                'index',
                'edit',
                'delete',
            ],
            'members' => [
                'index',
                'create',
                'edit',
                'delete',
            ],
            'roles' => [
                'index',
                'create',
                'edit',
                'delete',
            ],
            'availabilities' => [
                'index',
                'edit',
                'delete',
            ],
            'hallRates' => [
                'index',
                'create',
                'edit',
                'delete',
            ],
            'utilityCosts' => [
                'index',
                'edit',
            ],
            'interventions' => [
                'index',
                'create',
                'edit',
                'delete',
            ],
            'contacts' => [
                'index',
                'create',
                'edit',
                'delete',
            ],
            'bookings' => [
                'index',
                'create',
                'edit',
                'delete',
            ],
        ];

        foreach ($permissions as $key => $permission) {
            foreach ($permission as $action) {
                $name = $key . '.' . $action;
                Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
            }
        }
    }
}
