<?php

namespace Database\Factories;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'phone' => $faker->phoneNumber(),
            'birth_date' => Carbon::now()->subYears(rand(10, 100)),
            'sex' => $faker->randomElement(enumToArray(Sex::class)),
            'city' => $faker->city(),
            'postal_code' => $faker->postcode(),
            'address' => $faker->streetAddress(),
            'status' => $faker->randomElement(enumToArray(MembersStatus::class)),
            'email' => $faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
