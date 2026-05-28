<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->word(),
        ];
    }

    public function assignedTo(User $user): TaskFactory
    {
        return $this->state(fn() => [
            'assigned_to' => $user->id,
        ]);
    }
}
