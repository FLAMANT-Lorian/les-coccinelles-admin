<?php

namespace Database\Factories;

use App\Models\HallRate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HallRateFactory extends Factory
{
    protected $model = HallRate::class;

    public function definition(): array
    {
        return [
            'base_price' => $this->faker->randomNumber(),
            'member_price' => $this->faker->randomNumber(),
            'type' => $this->faker->word()
        ];
    }
}
