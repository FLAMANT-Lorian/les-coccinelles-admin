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

        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => true
        ])->givePermissionTo($permissions);

        User::factory()
            ->create([
                'first_name' => 'Lorian',
                'last_name' => 'Flamant',
                'email' => 'test@test.be',
            ])
            ->assignRole($role);
    }
}
