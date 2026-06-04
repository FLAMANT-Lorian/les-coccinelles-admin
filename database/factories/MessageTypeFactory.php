<?php

namespace Database\Factories;

use App\Enums\MessageTypes;
use App\Models\MessageType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageTypeFactory extends Factory
{
    protected $model = MessageType::class;

    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'name' => $faker->name,
        ];
    }
}
