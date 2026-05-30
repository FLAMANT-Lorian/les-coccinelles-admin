<?php

namespace Database\Factories;

use App\Enums\DepositStatus;
use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\Contact;
use App\Models\HallRate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'uniqid' => uniqid(),
            'message' => $faker->realText(100),
            'billing_address' => $faker->address,
            'company_name' => $faker->company,
            'deposit_status' => $faker->randomElement(enumToArray(DepositStatus::class)),
            'prepayment' => null,
            'cleaning' => null,
            'breaking' => null,
        ];
    }

    public function contact(Contact $contact): BookingFactory
    {
        return $this->state(fn() => [
            'contact_id' => $contact->id,
        ]);
    }

    public function type(HallRate $hallRate): BookingFactory
    {
        return $this->state(fn() => [
            'hall_rate_id' => $hallRate->id
        ]);
    }
}
