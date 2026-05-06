<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Enums\UtilityCostsStatus;
use App\Models\HallRate;
use App\Models\User;
use App\Models\UtilityCost;
use App\Rules\UniqueRole;
use App\Traits\CleanLivewireTMPFolder;
use App\Traits\HandleImages;
use App\ValueObjects\Money;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Spatie\Permission\Models\Role;

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
        $this->price = $utilityCost->price;
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
