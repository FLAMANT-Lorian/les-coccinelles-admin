<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateMembersForm extends Form
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone;
    public string $address;
    public string $postal_code;
    public string $city;
    public string $password;
    public string $role;
    public string $status;
    public ?string $sex = null;
    public ?string $birth_date = null;

    public function rules(): array
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'postal_code' => 'required|int',
            'password' => 'required',
            'birth_date' => '',
            'sex' => ['nullable', Rule::enum(Sex::class)],
            'role' => 'required|exists:roles,name',
            'status' => ['required', Rule::enum(MembersStatus::class)],
            'address' => 'required',
        ];
    }

    public function save()
    {
        /*User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);*/
    }
}
