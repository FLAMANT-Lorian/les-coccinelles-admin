<?php

namespace Database\Factories;

use App\Enums\MessageStatus;
use App\Models\AvailabilityRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailabilityRequestFactory extends Factory
{
    protected $model = AvailabilityRequest::class;

    public function definition(): array
    {

        $faker = $this->faker;

        $states = enumToArray(MessageStatus::class);

        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'subject' => $faker->sentence,
            'message' => $faker->text,
            'status' => $faker->randomElement($states),
            'acceptance' => $faker->boolean,
            'created_at' => Carbon::now()->subDays(rand(1, 30)),
        ];
    }
}
