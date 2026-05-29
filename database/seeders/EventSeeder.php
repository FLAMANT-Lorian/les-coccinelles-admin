<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory()
            ->has(Folder::factory())
            ->has(Task::factory()
                ->count(4)
                ->assignedTo(User::first())
            )->count(15)
            ->create();
    }
}
