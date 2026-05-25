<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'uniqid' => $faker->word(),
            'name' => $faker->word(),
            'date' => Carbon::now(),
            'hour' => Carbon::now()->format('H:i'),
            'address' => $faker->address(),
            'description' => $faker->text('150')
        ];
    }
}
