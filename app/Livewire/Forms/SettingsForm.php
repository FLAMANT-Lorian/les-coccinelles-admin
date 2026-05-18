<?php

namespace App\Livewire\Forms;

use App\Enums\Sex;
use App\Models\User;
use App\Traits\CleanLivewireTMPFolder;
use App\Traits\HandleImages;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class SettingsForm extends Form
{
    use HandleImages;
    use CleanLivewireTMPFolder;

    public ?User $user = null;

    public ?string $first_name = null;
    public ?string $last_name = null;
    public string $email;
    public string $phone;
    public string $address;
    public string $postal_code;
    public string $city;
    public ?string $sex = null;
    public ?string $birth_date = null;
    public ?TemporaryUploadedFile $avatar = null;
    public ?array $documents = null;

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->city = $user->city;
        $this->postal_code = $user->postal_code;
        $this->address = $user->address;
        $this->birth_date = $user->birth_date;
        $this->sex = $user->sex;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'phone' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'birth_date' => 'nullable',
            'sex' => ['nullable', Rule::enum(Sex::class)],
            'address' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,png,webp',
            'documents' => 'nullable|array',
            'documents.*' => 'mimes:jpg,png,webp',
        ];
    }

    public function update(): void
    {
        if ($this->avatar) {
            if ($this->user->avatar_path) {
                $this->removeOldAvatar($this->user->id);
            }

            $file_name = $this->storeAvatar($this->avatar);
        }

        if ($this->documents) {
            $documents = [];
            foreach ($this->documents as $idx => $document) {
                $documents[$idx] = $this->storeDocument($document);
            }

            $documents = array_merge($this->user->documents ?? [], $documents);
        }

        $this->user->update([
            'first_name' => empty(trim($this->first_name)) ? null : $this->first_name,
            'last_name' => empty(trim($this->last_name)) ? null : $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'birth_date' => $this->birth_date ?? null,
            'sex' => $this->sex ?? null,
            'address' => $this->address,
            'avatar_path' => $file_name ?? $this->user->avatar_path ?? null,
            'documents' => $documents ?? $this->user->documents ?? null,
        ]);

        $this->cleanLivewireTMPFolder();
    }
}
