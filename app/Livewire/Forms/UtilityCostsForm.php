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

    public ?float $price = null;
    public ?string $status = null;

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(UtilityCostsStatus::class)],
            'price' => 'required|numeric|min:0|decimal:0,2',
        ];
    }

    public function setUtilityCost($utilityCost): void
    {
        $this->utilityCost = $utilityCost;

        $this->price = Money::fromCents($utilityCost->price)->euros();
        $this->status = $utilityCost->status;
    }

    public function update(): void
    {
        $price = Money::fromEuros($this->price)->cents();

        $this->utilityCost->update([
            'price' => $price,
            'status' => $this->status,
        ]);
    }
}
