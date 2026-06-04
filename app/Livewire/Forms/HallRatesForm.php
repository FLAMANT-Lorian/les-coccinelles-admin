<?php

namespace App\Livewire\Forms;

use App\Models\HallRate;
use App\ValueObjects\Money;
use Livewire\Form;

class HallRatesForm extends Form
{
    public ?HallRate $hallRate = null;

    public ?string $type = null;
    public ?float $base_price = null;
    public ?float $member_price = null;
    public ?float $deposit = null;

    public function rules(): array
    {
        return [
            'type' => 'required',
            'base_price' => 'required|numeric|min:0|decimal:0,2',
            'member_price' => 'required|numeric|min:0|decimal:0,2',
            'deposit' => 'required|numeric|min:0|decimal:0,2',
        ];
    }

    public function setHallRate($hallRate): void
    {
        $this->hallRate = $hallRate;

        $this->type = $this->hallRate->type;
        $this->base_price = Money::fromCents($this->hallRate->base_price)->euros();
        $this->member_price = Money::fromCents($this->hallRate->member_price)->euros();
        $this->deposit = Money::fromCents($this->hallRate->deposit)->euros();
    }

    public function update(): void
    {
        $base_price = Money::fromEuros($this->base_price)->cents();
        $member_price = Money::fromEuros($this->member_price)->cents();
        $deposit = Money::fromEuros($this->deposit)->cents();

        $this->hallRate->update([
            'type' => $this->type,
            'base_price' => $base_price,
            'member_price' => $member_price,
            'deposit' => $deposit
        ]);
    }

    public function save(): void
    {
        $base_price = Money::fromEuros($this->base_price)->cents();
        $member_price = Money::fromEuros($this->member_price)->cents();
        $deposit = Money::fromEuros($this->deposit)->cents();

        HallRate::create([
            'type' => $this->type,
            'base_price' => $base_price,
            'member_price' => $member_price,
            'deposit' => $deposit
        ]);
    }
}
