<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();

        // SUPER ADMIN
        $superAdmin = Role::create([
            'name' => config('permission.super_admin_name'),
            'guard_name' => 'web',
            'unique' => true
        ]);

        $superAdmin->givePermissionTo($permissions);

        User::factory()
            ->create([
                'first_name' => 'Lorian',
                'last_name' => 'Flamant',
                'email' => 'lorian.flamant05@gmail.com',
                'password' => 'password',
            ])
            ->assignRole($superAdmin);

        // PRESIDENT
        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => true
        ])->givePermissionTo($permissions);

        User::factory()
            ->create([
                'first_name' => 'John',
                'last_name' => 'doe',
                'password' => 'password',
            ])
            ->assignRole($role);

        // MEMBRE
        Role::create([
            'name' => 'Membre',
            'guard_name' => 'web',
            'unique' => false
        ]);
    }
}
