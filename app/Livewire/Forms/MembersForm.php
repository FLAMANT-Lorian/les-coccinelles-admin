<?php

namespace App\Livewire\Forms;

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Models\Role;
use App\Models\User;
use App\Rules\UniqueRole;
use App\Traits\CleanLivewireTMPFolder;
use App\Traits\HandleImages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

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
    public ?int $role = null;
    public ?string $status = null;
    public ?string $sex = null;
    public ?string $birth_date = null;
    public ?TemporaryUploadedFile $avatar = null;
    public ?array $documents = null;

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
        $this->role = $member->roles()->first()->id;
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
            'password' => $this->member ? 'nullable' : 'required|min:10',
            'birth_date' => 'nullable',
            'sex' => ['nullable', Rule::enum(Sex::class)],
            'role' => [
                'required',
                'exists:roles,id',
                new UniqueRole($this->member),
            ],
            'status' => ['required', Rule::enum(MembersStatus::class)],
            'address' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,png,webp',
            'documents' => 'nullable|array',
            'documents.*' => 'mimes:jpg,png,webp',
        ];
    }

    public function update(): void
    {
        $role = Role::where('id', $this->role)->first();

        if (!$role || !$this->member) return;

        if ($this->avatar) {
            if ($this->member->avatar_path) {
                $this->removeOldAvatar($this->member->id);
            }

            $file_name = $this->storeAvatar($this->avatar);
        }

        if ($this->documents) {
            $documents = [];
            foreach ($this->documents as $idx => $document) {
                $documents[$idx] = $this->storeDocument($document);
            }

            $documents = array_merge($this->member->documents ?? [], $documents);
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
            'avatar_path' => $file_name ?? $this->member->avatar_path ?? null,
            'documents' => $documents ?? $this->member->documents ?? null,
        ]);

        $this->member->syncRoles($role);

        $this->cleanLivewireTMPFolder();
    }

    public function save(): ?array
    {
        $role = Role::where('id', $this->role)->first();

        if (!$role) return null;

        if ($this->avatar) {
            $file_name = $this->storeAvatar($this->avatar);
        }

        if ($this->documents) {
            $documents = [];
            foreach ($this->documents as $idx => $document) {
                $documents[$idx] = $this->storeDocument($document);
            }
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
            'documents' => empty($documents) ? null : $documents,
            'notifications' => [
                'messages' => true,
                'events' => true,
                'bookings' => true,
                'meetings' => true,
                'interventions' => true,
            ],
        ]);

        $user->assignRole($role);

        return [
            'user' => $user,
            'old_password' => $this->password
        ];
    }
}
