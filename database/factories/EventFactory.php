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
            'name' => $faker->word(),
            'start_date' => Carbon::now()->addDays(rand(-3, 3)),
            'end_date' => Carbon::now()->addDays(rand(4, 7)),
            'address' => $faker->address(),
            'description' => $faker->text('150')
        ];
    }
}
