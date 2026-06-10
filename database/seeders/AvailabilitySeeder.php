<?php

namespace Database\Seeders;

use App\Enums\MessageStatus;
use App\Models\AvailabilityRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AvailabilityRequest::factory()
            ->create([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@doe.com',
                'phone' => '+32 000 00 00 00',
                'subject' => 'Demande de réservation de la salle',
                'message' => 'Bonjour, la salle est-elle libre le week-end prochain ?',
                'acceptance' => 1,
                'status' => MessageStatus::Unread->value
            ]);

        AvailabilityRequest::factory()->count(2)->create();
    }
}
