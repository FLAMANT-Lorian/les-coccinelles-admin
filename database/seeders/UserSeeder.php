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
        $permissions = Permission::pluck('name');

        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => true
        ])->givePermissionTo($permissions);

        $role2 = Role::create([
            'name' => 'Membre',
            'guard_name' => 'web',
            'unique' => false
        ]);

        User::factory()
            ->create([
                'first_name' => 'Lorian',
                'last_name' => 'Flamant',
                'email' => 'test@test.be',
            ])
            ->assignRole($role);

        User::factory()
            ->create([
                'email' => 'tests@test.be'
            ])
            ->assignRole($role2);
    }
}
