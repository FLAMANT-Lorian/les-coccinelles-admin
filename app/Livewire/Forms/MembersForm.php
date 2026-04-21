<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\User;
use App\Rules\UniqueRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;

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
    public ?string $password = null;
    public string $role;
    public string $status;
    public ?string $sex = null;
    public ?string $birth_date = null;

    public function setMember(User $member): void
    {
        $this->member = $member;

        $this->first_name = $member->first_name;
        $this->last_name = $member->last_name;
        $this->email = $member->email;
        $this->phone = $member->phone;
        $this->city = $member->city;
        $this->postal_code = $member->postal_code;
        $this->address = $member->address;
        $this->birth_date = $member->birth_date;
        $this->sex = $member->sex;
        $this->status = $member->status;
        $this->role = $member->getRoleNames()->first();
    }

    public function rules(): array
    {
        return [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->member),
            ],
            'phone' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'password' => $this->member ? 'nullable' : 'required',
            'birth_date' => 'nullable',
            'sex' => ['nullable', Rule::enum(Sex::class)],
            'role' => [
                'required',
                'exists:roles,name',
                new UniqueRole($this->member),
            ],
            'status' => ['required', Rule::enum(MembersStatus::class)],
            'address' => 'required',
        ];
    }

    public function update(): void
    {
        $role = Role::where('name', $this->role)->first();

        if (!$role || !$this->member) return;

        $this->member->syncRoles($role);

        $this->member->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'birth_date' => $this->birth_date,
            'sex' => $this->sex,
            'status' => $this->status,
            'address' => $this->address,
        ]);
    }

    public function save(): void
    {
        $role = Role::where('name', $this->role)->first();

        if (!$role) return;

        User::create([
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

        $this->member->syncRoles($role);
    }
}
