<?php

namespace Database\Factories;

use App\Enums\UtilityCostsStatus;
use App\Models\UtilityCost;
use Illuminate\Database\Eloquent\Factories\Factory;

class UtilityCostFactory extends Factory
{
    protected $model = UtilityCost::class;

    public function definition(): array
    {
        $unit = ['m3', 'kWh', 'litre'];

        return [
            'type' => $this->faker->word(),
            'price' => $this->faker->randomNumber(),
            'unit' => $this->faker->randomElement($unit),
            'status' => $this->faker->randomElement(enumToArray(UtilityCostsStatus::class)),
        ];
    }
}
