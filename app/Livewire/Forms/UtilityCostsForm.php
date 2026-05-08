<?php

namespace App\Livewire\Forms;

use App\Enums\UtilityCostsStatus;
use App\Models\UtilityCost;
use App\ValueObjects\Money;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UtilityCostsForm extends Form
{
    public ?UtilityCost $utilityCost = null;

    public ?string $type = null;
    public ?float $price = null;
    public ?string $status = null;
    public ?string $unit = null;

    public function rules(): array
    {
        return [
            'type' => 'required',
            'status' => ['required', Rule::enum(UtilityCostsStatus::class)],
            'price' => 'required|numeric|min:0|decimal:0,2',
            'unit' => 'required',
        ];
    }

    public function setUtilityCost($utilityCost): void
    {
        $this->utilityCost = $utilityCost;

        $this->type = $utilityCost->type;
        $this->price = Money::fromCents($utilityCost->price)->euros();
        $this->status = $utilityCost->status;
        $this->unit = $utilityCost->unit;
    }

    public function update(): void
    {
        $price = Money::fromEuros($this->price)->cents();

        $this->utilityCost->update([
            'type' => $this->type,
            'price' => $price,
            'status' => $this->status,
            'unit' => $this->unit,
        ]);
    }

    public function save(): void
    {
        $price = Money::fromEuros($this->price)->cents();

        UtilityCost::create([
            'type' => $this->type,
            'price' => $price,
            'status' => $this->status,
            'unit' => $this->unit,
        ]);
    }
}
