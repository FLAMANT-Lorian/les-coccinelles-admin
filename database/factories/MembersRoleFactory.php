<?php

namespace Database\Factories;

use App\Models\MembersRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MembersRoleFactory extends Factory
{
    protected $model = MembersRole::class;

    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'name' => $faker->word(),
            'unique' => $faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
