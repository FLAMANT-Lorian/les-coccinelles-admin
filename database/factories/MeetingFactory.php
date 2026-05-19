<?php

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MeetingFactory extends Factory
{
    protected $model = Meeting::class;

    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'address' => $faker->address(),
            'date' => Carbon::now()->addDays(rand(-5, 5)),
            'hour' => $faker->time(),
            'description' => $faker->text()
        ];
    }
}
