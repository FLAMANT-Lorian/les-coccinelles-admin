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

        $contact = Contact::factory()->create();
        $start_date = str_replace('-', '', Carbon::now()->addDay()->format('Y-m-d'));

        $uniqid = $start_date . '-' . $contact->first_name . '-' . $contact->last_name;

        return [
            'uniqid' => $uniqid,
            'message' => $faker->realText(100),
            'billing_address' => $faker->address,
            'company_name' => $faker->company,
            'deposit_status' => $faker->randomNumber(DepositStatus::cases()),
            'prepayment' => $faker->randomNumber(),
            'cleaning' => $faker->randomNumber(),
            'breaking' => $faker->randomNumber(),
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

    public function date(BookingDate $date): BookingFactory
    {
        return $this->state(fn() => [
            'booking_date_id' => $date->id
        ]);
    }
}
