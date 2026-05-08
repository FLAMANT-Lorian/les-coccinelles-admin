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

    public function rules(): array
    {
        return [
            'type' => 'required',
            'base_price' => 'required|numeric|min:0|decimal:0,2',
            'member_price' => 'required|numeric|min:0|decimal:0,2',
        ];
    }

    public function setHallRate($hallRate): void
    {
        $this->hallRate = $hallRate;
        $this->type = $hallRate->type;
        $this->base_price = Money::fromCents($hallRate->base_price)->euros();
        $this->member_price = Money::fromCents($hallRate->member_price)->euros();
    }

    public function update(): void
    {
        $base_price = Money::fromEuros($this->base_price)->cents();
        $member_price = Money::fromEuros($this->member_price)->cents();

        $this->hallRate->update([
            'type' => $this->type,
            'base_price' => $base_price,
            'member_price' => $member_price,
        ]);
    }

    public function save(): void
    {
        $base_price = Money::fromEuros($this->base_price)->cents();
        $member_price = Money::fromEuros($this->member_price)->cents();

        HallRate::create([
            'type' => $this->type,
            'base_price' => $base_price,
            'member_price' => $member_price,
        ]);
    }
}
