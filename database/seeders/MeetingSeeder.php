<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all()->pluck('id');

        $meeting = Meeting::factory()->create();

        $meeting->participants()->attach($users);
    }
}
