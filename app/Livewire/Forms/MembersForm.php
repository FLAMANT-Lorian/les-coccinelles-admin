<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\User;
use App\Rules\UniqueRole;
use App\Traits\CleanLivewireTMPFolder;
use App\Traits\HandleImages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class MembersForm extends Form
{
    use HandleImages;
    use CleanLivewireTMPFolder;

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
    public ?TemporaryUploadedFile $avatar = null;

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
        $this->role = $member->roles()->first()->name;
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ];
    }

    public function update(): void
    {
        $role = Role::where('name', $this->role)->first();

        if (!$role || !$this->member) return;

        if ($this->avatar) {
            $this->removeOldAvatar($this->member->avatar_path);

            $file_name = $this->storeAvatar($this->avatar);
        }

        $this->member->update([
            'first_name' => empty(trim($this->first_name)) ? null : $this->first_name,
            'last_name' => empty(trim($this->last_name)) ? null : $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'birth_date' => $this->birth_date ?? null,
            'sex' => $this->sex ?? null,
            'status' => $this->status,
            'address' => $this->address,
            'avatar_path' => $file_name ?? null
        ]);

        $this->member->syncRoles($role);

        $this->cleanLivewireTMPFolder();
    }

    public function save(): void
    {
        $role = Role::where('name', $this->role)->first();

        if (!$role) return;

        if ($this->avatar) {
            $file_name = $this->storeAvatar($this->avatar);
        }

        $user = User::create([
            'first_name' => empty(trim($this->first_name)) ? null : trim($this->first_name),
            'last_name' => empty(trim($this->last_name)) ? null : trim($this->last_name),
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'password' => Hash::make($this->password),
            'birth_date' => $this->birth_date ?? null,
            'sex' => $this->sex ?? null,
            'status' => $this->status,
            'address' => $this->address,
            'avatar_path' => $file_name ?? null,
        ]);

        $user->assignRole($role);

        $this->cleanLivewireTMPFolder();
    }


    public function deleteMember(): void
    {
        $this->member->delete();
    }
}
