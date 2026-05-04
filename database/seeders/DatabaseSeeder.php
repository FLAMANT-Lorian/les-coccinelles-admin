<?php

namespace Database\Seeders;

use App\Models\AvailabilityRequest;
use App\Models\Message;
use App\Models\User;
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
        $this->createPermissions();

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

        $role3 = Role::create([
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

        Message::factory()
            ->count(30)
            ->create();

        AvailabilityRequest::factory()
            ->count(30)
            ->create();
    }

    private function createPermissions(): void
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
            ]
        ];

        foreach ($permissions as $key => $permission) {
            foreach ($permission as $action) {
                $name = $key . '.' . $action;
                Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
            }
        }
    }
}
