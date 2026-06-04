<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\MeterReading;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeterReadingFactory extends Factory
{
    protected $model = MeterReading::class;

    public function definition(): array
    {
        return [
            'before_water_general' => 11.15,
            'after_water_general' => 12.19,
            'before_water_cdj' => 100,
            'after_water_cdj' => 100,
            'before_electricity_general' => 154585,
            'after_electricity_general' => 154669,
            'before_electricity_cdj' => 639,
            'after_electricity_cdj' => 656,
            'before_mazout_general' => 7528,
            'after_mazout_general' => 7532,
        ];
    }
}
