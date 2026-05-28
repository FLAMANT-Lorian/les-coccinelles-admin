<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Folder;
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
            ->count(2)
            ->create();
    }
}
