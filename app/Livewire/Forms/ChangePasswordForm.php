<?php

namespace App\Livewire\Forms;

use App\Enums\Sex;
use App\Models\User;
use App\Traits\CleanLivewireTMPFolder;
use App\Traits\HandleImages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ChangePasswordForm extends Form
{
    public string $old_password;
    public string $new_password;

    public function rules(): array
    {
        return [
            'old_password' => 'required|current_password',
            'new_password' => 'required|different:old_password|min:10'
        ];
    }

    public function update(): void
    {
        $password = Hash::make($this->new_password);

        auth()->user()->update([
            'password' => $password,
        ]);
    }
}
