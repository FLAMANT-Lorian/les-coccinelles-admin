<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolderFactory extends Factory
{
    protected $model = Folder::class;

    public function definition(): array
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'path' => slugify($name),
            'color' => $this->faker->hexColor()
        ];
    }
}
