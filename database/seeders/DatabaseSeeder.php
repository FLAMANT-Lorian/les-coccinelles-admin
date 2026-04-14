<?php

namespace Database\Seeders;

use App\Enums\MessageTypes;
use App\Models\MembersRole;
use App\Models\Message;
use App\Models\MessageType;
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
        User::factory()->create([
            'name' => 'Flamant Lorian',
            'email' => 'test@test.be',
        ]);

        foreach (MessageTypes::cases() as $messages_type) {
            MessageType::factory()
                ->has(Message::factory()->count(30))
                ->create([
                    'name' => $messages_type->value,
                ]);
        }

        MembersRole::factory()->create([
            'name' => 'Super Admin',
            'unique' => true,
        ]);

        MembersRole::factory()->create([
            'name' => 'Président',
            'unique' => true,
        ]);

        MembersRole::factory()->create([
            'name' => 'Membre',
            'unique' => false,
        ]);
    }
}
