<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FolderFactory extends Factory
{
    protected $model = Folder::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'color' => $this->faker->hexColor()
        ];
    }
}
