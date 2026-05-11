<?php

namespace App\Livewire\Forms;

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
    public string $start_date;
    public string $end_date;
    public string $handover_date;
    public string $return_date;
    public string $message;
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
}
