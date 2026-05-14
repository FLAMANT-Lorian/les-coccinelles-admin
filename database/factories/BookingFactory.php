<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\User;
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
            'key_handover_date' => Carbon::now()->subDays(3),
            'key_return_date' => Carbon::now()->subDay(),
            'start_date' => Carbon::now()->subDays(3),
            'end_date' => Carbon::now()->subDay(),
            'message' => $faker->realText(100),
            'billing_address' => $faker->address
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
