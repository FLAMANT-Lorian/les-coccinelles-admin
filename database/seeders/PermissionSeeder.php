<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'update',
                'delete',
            ],
            'members' => [
                'index',
                'create',
                'update',
                'delete',
            ],
            'roles' => [
                'index',
                'create',
                'update',
                'delete',
            ],
            'availabilities' => [
                'index',
                'update',
                'delete',
            ],
            'hallRates' => [
                'index',
                'create',
                'update',
                'delete',
            ],
            'utilityCosts' => [
                'index',
                'create',
                'update',
                'delete',
            ],
            'interventions' => [
                'index',
                'create',
                'update',
                'delete',
            ],
            'contacts' => [
                'index',
                'create',
                'update',
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
