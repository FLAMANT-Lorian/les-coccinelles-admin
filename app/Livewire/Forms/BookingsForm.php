<?php

namespace App\Livewire\Forms;

use App\Enums\DepositStatus;
use App\Enums\YesOrNo;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use App\Rules\DateNotReserved;
use App\ValueObjects\Money;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Form;

class BookingsForm extends Form
{
    public ?Booking $booking = null;

    // FIELDSET 1
    public ?int $tenant = null;
    public string $last_name;
    public string $first_name;
    public string $email;
    public string $phone;
    public ?string $member_card = null;
    public string $address;

    //FIELDSET 2
    public ?string $company_name = null;
    public ?int $type = null;
    public ?string $deposit_status = null;
    public ?float $prepayment = null;

    public ?string $message = null;
    public string $billing_address;

    // FIELDSET 3
    public string $dates;
    public string $handover_date;
    public string $handover_hour;
    public string $return_date;
    public string $return_hour;

    // FIELDSET 4
    public ?float $before_water_general = null;
    public ?float $after_water_general = null;
    public ?float $before_water_cdj = null;
    public ?float $after_water_cdj = null;
    public ?int $before_electricity_general = null;
    public ?int $after_electricity_general = null;
    public ?int $before_electricity_cdj = null;
    public ?int $after_electricity_cdj = null;
    public ?int $before_mazout_general = null;
    public ?int $after_mazout_general = null;

    // FIELDSET 5
    public ?float $cleaning = null;
    public ?float $breaking = null;

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
            'company_name' => '',
            'type' => 'required|exists:hall_rates,id',
            'deposit_status' => ['required', Rule::enum(DepositStatus::class)],
            'prepayment' => 'nullable|numeric|min:0|decimal:0,2',
            'message' => '',
            'billing_address' => 'required',

            // DATES
            'dates' => ['required', new DateNotReserved($this->booking)],
            'handover_date' => 'required',
            'handover_hour' => 'required',
            'return_date' => 'required',
            'return_hour' => 'required',

            // METER READING
            'before_water_general' => 'nullable|numeric|decimal:0,2',
            'after_water_general' => 'nullable|numeric|decimal:0,2',
            'before_water_cdj' => 'nullable|numeric|decimal:0,2',
            'after_water_cdj' => 'nullable|numeric|decimal:0,2',
            'before_electricity_general' => 'nullable|numeric|integer',
            'after_electricity_general' => 'nullable|numeric|integer',
            'before_electricity_cdj' => 'nullable|numeric|integer',
            'after_electricity_cdj' => 'nullable|numeric|integer',
            'before_mazout_general' => 'nullable|numeric|integer',
            'after_mazout_general' => 'nullable|numeric|integer',

            // OTHERS COSTS
            'cleaning' => 'nullable|numeric|min:0|decimal:0,2',
            'breaking' => 'nullable|numeric|min:0|decimal:0,2',
        ];
    }

    public function setBooking(Booking $booking): void
    {
        $this->booking = $booking;

        $this->tenant = $booking->contact->id;
        $this->type = $booking->hall_rate->id;

        if (Carbon::parse($booking->bookingDate->start_date)->format('Y-m-d') === Carbon::parse($booking->bookingDate->end_date)->format('Y-m-d')) {
            $this->dates = $booking->bookingDate->start_date->format('Y-m-d');
        } else {
            $this->dates = $booking->bookingDate->start_date->format('Y-m-d') . __('general.date-picker-format') . $booking->bookingDate->end_date->format('Y-m-d');
        }
        $this->handover_date = $booking->bookingDate->key_handover_date;
        $this->handover_hour = Carbon::parse($booking->bookingDate->key_handover_hour)->format('H:i');
        $this->return_date = $booking->bookingDate->key_return_date;
        $this->return_hour = Carbon::parse($booking->bookingDate->key_return_hour)->format('H:i');

        $this->company_name = $booking->company_name;
        $this->message = $booking->message ?? null;
        $this->billing_address = $booking->billing_address;
        $this->deposit_status = $booking->deposit_status;
        $this->prepayment = $booking->prepayment ? Money::fromCents($booking->prepayment)->euros() : null;
        $this->cleaning = $booking->cleaning ? Money::fromCents($booking->cleaning)->euros() : null;
        $this->breaking = $booking->breaking ? Money::fromCents($booking->breaking)->euros() : null;

        $meter_reading = $booking->meterReading;
        $this->before_water_general = $meter_reading->before_water_general;
        $this->after_water_general = $meter_reading->after_water_general;
        $this->before_water_cdj = $meter_reading->before_water_cdj;
        $this->after_water_cdj = $meter_reading->after_water_cdj;
        $this->before_electricity_general = $meter_reading->before_electricity_general;
        $this->after_electricity_general = $meter_reading->after_electricity_general;
        $this->before_electricity_cdj = $meter_reading->before_electricity_cdj;
        $this->after_electricity_cdj = $meter_reading->after_electricity_cdj;
        $this->before_mazout_general = $meter_reading->before_mazout_general;
        $this->after_mazout_general = $meter_reading->after_mazout_general;
    }

    public function save(): Booking
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

        $start_date = '';
        $end_date = '';

        if (str_contains($this->dates, __('general.date-picker-format'))) {
            [$start_date, $end_date] = explode(__('general.date-picker-format'), $this->dates);
        } else {
            $start_date = $this->dates;
            $end_date = $this->dates;
        }

        $uniqid = str_replace('-', '', $start_date) . '-' . $contact->first_name . '-' . $contact->last_name;

        $booking = Booking::create([
            'uniqid' => $uniqid,
            'contact_id' => $contact->id,
            'hall_rate_id' => $type->id,
            'message' => $this->message,
            'billing_address' => $this->billing_address,
            'company_name' => $this->company_name ?? null,
            'deposit_status' => $this->deposit_status,
            'prepayment' => $this->prepayment ? Money::fromEuros($this->prepayment)->cents() : null,
            'cleaning' => $this->cleaning ? Money::fromEuros($this->cleaning)->cents() : null,
            'breaking' => $this->breaking ? Money::fromEuros($this->breaking)->cents() : null,
        ]);

        $booking->bookingDate()->create([
            'key_handover_date' => Carbon::parse($this->handover_date)->format('Y-m-d'),
            'key_handover_hour' => $this->handover_hour,
            'key_return_date' => Carbon::parse($this->return_date)->format('Y-m-d'),
            'key_return_hour' => $this->return_hour,
            'start_date' => Carbon::parse($start_date)->startOfDay(),
            'end_date' => Carbon::parse($end_date)->endOfDay(),
        ]);

        $booking->meterReading()->create([
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

        return $booking;
    }

    public function update(): void
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

        $start_date = '';
        $end_date = '';

        if (str_contains($this->dates, __('general.date-picker-format'))) {
            [$start_date, $end_date] = explode(__('general.date-picker-format'), $this->dates);
        } else {
            $start_date = $this->dates;
            $end_date = $this->dates;
        }

        $uniqid = str_replace('-', '', $start_date) . '-' . $contact->first_name . '-' . $contact->last_name;

        $this->booking->update([
            'uniqid' => $uniqid,
            'contact_id' => $contact->id,
            'hall_rate_id' => $type->id,
            'message' => $this->message,
            'billing_address' => $this->billing_address,
            'company_name' => $this->company_name ?? null,
            'deposit_status' => $this->deposit_status,
            'prepayment' => $this->prepayment ? Money::fromEuros($this->prepayment)->cents() : null,
            'cleaning' => $this->cleaning ? Money::fromEuros($this->cleaning)->cents() : null,
            'breaking' => $this->breaking ? Money::fromEuros($this->breaking)->cents() : null,
        ]);

        $this->booking->bookingDate()->update([
            'key_handover_date' => Carbon::parse($this->handover_date)->format('Y-m-d'),
            'key_handover_hour' => $this->handover_hour,
            'key_return_date' => Carbon::parse($this->return_date)->format('Y-m-d'),
            'key_return_hour' => $this->return_hour,
            'start_date' => Carbon::parse($start_date)->startOfDay(),
            'end_date' => Carbon::parse($end_date)->endOfDay(),
        ]);

        $this->booking->meterReading()->update([
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
    }
}
