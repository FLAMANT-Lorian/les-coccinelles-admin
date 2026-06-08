<?php

namespace Database\Factories;

use App\Enums\InterventionStatus;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InterventionFactory extends Factory
{
    protected $model = Intervention::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement(enumToArray(InterventionStatus::class)),
            'deadline' => Carbon::now()->addDays(3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function createdBy(User $user): InterventionFactory
    {
        return $this->state(fn() => [
            'created_by' => $user->id,
        ]);
    }

    public function assignedTo(User $user): InterventionFactory
    {
        return $this->state(fn() => [
            'assigned_to' => $user->id,
        ]);
    }
}
