<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::whereDoesntHave('roles', function (Builder $q) {
            $q->where('name', config('permission.super_admin_name'));
        })->first();

        Event::factory()
            ->has(Folder::factory())
            ->has(Task::factory()
                ->count(3)
                ->assignedTo($user)
            )->count(1)
            ->create();
    }
}
