<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\HallRate;
use App\Models\User;
use App\Rules\UniqueRole;
use App\Traits\CleanLivewireTMPFolder;
use App\Traits\HandleImages;
use App\ValueObjects\Money;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Spatie\Permission\Models\Role;

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
        $base_price = Money::fromCents($hallRate->base_price)->euros();
        $member_price = Money::fromCents($hallRate->member_price)->euros();

        $this->hallRate = $hallRate;
        $this->type = $hallRate->type;
        $this->base_price = $base_price;
        $this->member_price = $member_price;
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
