<?php

namespace App\Livewire\Forms;

use App\Enums\BookingStatus;
use App\Enums\YesOrNo;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\MeterReading;
use Illuminate\Validation\Rule;
use Livewire\Form;

class BookingsForm extends Form
{
    // FIELDSET 1
    public ?int $tenant = null;
    public string $last_name;
    public string $first_name;
    public string $email;
    public string $phone;
    public ?string $member_card = null;
    public string $address;

    //FIELDSET 2
    public ?int $type = null;
    public ?string $status = null;
    public string $dates;
    public string $handover_date;
    public string $return_date;
    public ?string $message = null;
    public string $billing_address;

    // FIELDSET 3
    public ?int $before_water_general = null;
    public ?int $after_water_general = null;
    public ?int $before_water_cdj = null;
    public ?int $after_water_cdj = null;
    public ?int $before_electricity_general = null;
    public ?int $after_electricity_general = null;
    public ?int $before_electricity_cdj = null;
    public ?int $after_electricity_cdj = null;
    public ?int $before_mazout_general = null;
    public ?int $after_mazout_general = null;

    public function rules(): array
    {
        return [
            // CONTACT
            'tenant' => 'nullable|exists:contacts,id',
            'last_name' => 'required_without:tenant',
            'first_name' => 'required_without:tenant',
            'email' => 'nullable|required_without:tenant|email|unique:contacts,email',
            'phone' => 'required_without:tenant',
            'member_card' => ['nullable', 'required_without:tenant', Rule::enum(YesOrNo::class)],
            'address' => 'required_without:tenant',

            // BOOKING
            'type' => 'required|exists:hall_rates,id',
            'status' => ['required', Rule::enum(BookingStatus::class)],
            'dates' => 'required',
            'handover_date' => 'required',
            'return_date' => 'required',
            'message' => '',
            'billing_address' => 'required',

            // METER READING
            'before_water_general' => '',
            'after_water_general' => '',
            'before_water_cdj' => '',
            'after_water_cdj' => '',
            'before_electricity_general' => '',
            'after_electricity_general' => '',
            'before_electricity_cdj' => '',
            'after_electricity_cdj' => '',
            'before_mazout_general' => '',
            'after_mazout_general' => '',
        ];
    }

    public function save(): void
    {
        if (!$this->tenant) {
            $contact = Contact::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'telephone' => $this->phone,
                'member_card' => YesOrNo::from($this->member_card)->toBoolean(),
                'address' => $this->address,
            ]);
        } else {
            $contact = Contact::findOrFail($this->tenant);
        }

        $type = HallRate::findOrFail($this->type);

        $meter_reading = MeterReading::create([
            'before_water_general' => $this->before_water_general ?? null,
            'after_water_general' => $this->after_water_general ?? null,
            'before_water_cdj' => $this->before_water_cdj ?? null,
            'after_water_cdj' => $this->after_water_cdj ?? null,
            'before_electricity_general' => $this->before_electricity_general ?? null,
            'after_electricity_general' => $this->after_electricity_general ?? null,
            'before_electricity_cdj' => $this->before_electricity_cdj ?? null,
            'after_electricity_cdj' => $this->after_electricity_cdj ?? null,
            'before_mazout_general' => $this->before_mazout_general ?? null,
            'after_mazout_general' => $this->after_mazout_general ?? null
        ]);

        $start_date = '';
        $end_date = '';

        if (str_contains($this->dates, ' au ')) {
            [$start_date, $end_date] = explode(' au ', $this->dates);
        } else {
            $start_date = $this->dates;
            $end_date = $this->dates;
        }

        Booking::create([
            'contact_id' => $contact->id,
            'hall_rate_id' => $type->id,
            'meter_reading_id' => $meter_reading->id,
            'status' => $this->status,
            'key_handover_date' => $this->handover_date,
            'key_return_date' => $this->return_date,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'message' => $this->message,
            'billing_address' => $this->billing_address
        ]);
    }
}
