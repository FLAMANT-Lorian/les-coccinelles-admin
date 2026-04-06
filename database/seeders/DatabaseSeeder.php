<?php

namespace Database\Seeders;

use App\Enums\MessageTypes;
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
        $user = User::factory()->create([
            'name' => 'Flamant Lorian',
            'email' => 'test@test.be',
        ]);

        foreach (MessageTypes::cases() as $messages_type) {
            MessageType::factory()
                ->has(Message::factory()->count(10))
                ->create([
                'name' => $messages_type->value,
            ]);
        }
    }
}
