<?php

namespace App\Livewire\Forms;

use App\Enums\YesOrNo;
use App\Traits\CustomPermissions;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    use CustomPermissions;

    public string $name;
    public string $unique;

    public function rules(): array
    {
        return [
            'name' => 'required',
            'unique' => ['required', Rule::enum(YesOrNo::class)],
        ];
    }


    public function save(): void
    {
        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
            'unique' => YesOrNo::from($this->unique)->toBoolean(),
        ]);
    }
}
