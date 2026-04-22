<?php

namespace Database\Seeders;

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
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

        $role = Role::create([
            'name' => 'Président',
            'guard_name' => 'web',
            'unique' => true
        ]);

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

        $user2 = User::factory()->create();

        $user2->assignRole($role2->name);

        foreach (MessageTypes::cases() as $messages_type) {
            MessageType::factory()
                ->has(Message::factory()->count(30))
                ->create([
                    'name' => $messages_type->value,
                ]);
        }
    }

    private function createPermissions(): void
    {
        $messages_permissions = [
            'messages.index',
            'messages.delete',
        ];
        foreach ($messages_permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
