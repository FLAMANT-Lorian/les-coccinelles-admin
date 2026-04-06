<?php

namespace Database\Factories;

use App\Enums\MessageStatus;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {

        $faker = $this->faker;

        $states = array_map(function (MessageStatus $status) {
            return $status->value;
        }, MessageStatus::cases());

        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'subject' => $faker->sentence,
            'message' => $faker->text,
            'status' => $faker->randomElement($states),
        ];
    }
}
