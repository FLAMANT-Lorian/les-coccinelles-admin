<?php

namespace Database\Seeders;

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::factory()->create([
            'name' => 'Président',
            'unique' => true
        ]);

        User::factory()
            ->for($role)
            ->create([
            'first_name' => 'Lorian',
            'last_name' => 'Flamant',
            'email' => 'test@test.be',
        ]);

        foreach (MessageTypes::cases() as $messages_type) {
            MessageType::factory()
                ->has(Message::factory()->count(30))
                ->create([
                    'name' => $messages_type->value,
                ]);
        }
    }
}
