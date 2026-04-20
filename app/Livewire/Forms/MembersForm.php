<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Form;

class MembersForm extends Form
{
    public ?User $member = null;

    public ?string $first_name = null;
    public ?string $last_name = null;
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
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'postal_code' => 'required|int',
            'password' => 'required',
            'birth_date' => 'nullable',
            'sex' => ['nullable', Rule::enum(Sex::class)],
            'role' => [
                'required',
                'exists:roles,name',
                function ($attribute, $value, $fail) {
                    if (Role::where('name', $value)
                        ->where('unique', true)
                        ->whereHas('users')->exists()) {
                        $fail(__('forms.role-is-already-use'));
                    }
                },
            ],
            'status' => ['required', Rule::enum(MembersStatus::class)],
            'address' => 'required',
        ];
    }

    public function save(): void
    {
        $role = Role::where('name', $this->role)->first();

        if (!$role) return;

        $role->users()->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'password' => Hash::make($this->password),
            'birth_date' => $this->birth_date,
            'sex' => $this->sex,
            'status' => $this->status,
            'address' => $this->address,
        ]);
    }
}
