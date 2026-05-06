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
        ]);

        $role->givePermissionTo($permissions);

        $role2 = Role::create([
            'name' => 'Membre',
            'guard_name' => 'web',
            'unique' => false
        ]);

        Role::create([
            'name' => 'Trésorier',
            'guard_name' => 'web',
            'unique' => true
        ]);

        $user1 = User::factory()
            ->create([
                'first_name' => 'Lorian',
                'last_name' => 'Flamant',
                'email' => 'test@test.be',
            ]);
        $user1->assignRole($role->name);

        $user2 = User::factory()->create(
            ['email' => 'tests@test.be']
        );

        $user2->assignRole($role2->name);
    }
}
