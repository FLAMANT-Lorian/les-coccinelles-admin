<?php

namespace Database\Factories;

use App\Models\MeterReading;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MeterReadingFactory extends Factory
{
    protected $model = MeterReading::class;

    public function definition(): array
    {
        return [
            'before_water_general' => $this->faker->randomNumber(),
            'after_water_general' => $this->faker->randomNumber(),
            'before_water_cdj' => $this->faker->randomNumber(),
            'after_water_cdj' => $this->faker->randomNumber(),
            'before_electricity_general' => $this->faker->randomNumber(),
            'after_electricity_general' => $this->faker->randomNumber(),
            'before_electricity_cdj' => $this->faker->randomNumber(),
            'after_electricity_cdj' => $this->faker->randomNumber(),
            'before_mazout_general' => $this->faker->randomNumber(),
            'after_mazout_general' => $this->faker->randomNumber(),
        ];
    }
}
