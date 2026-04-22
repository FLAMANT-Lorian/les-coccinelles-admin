<?php

namespace App\Livewire\Forms;

use App\Enums\YesOrNo;
use App\Traits\CustomPermissions;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    use CustomPermissions;

    public string $name;
    public string $unique;
    public ?Role $role = null;

    public function setRole(Role $role): void
    {
        $this->role = $role;
        $this->name = $this->role->name;
        $this->unique = $this->role->unique ? YesOrNo::YES->value : YesOrNo::NO->value;

        $this->setPermissions();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($this->role),
            ],
            'unique' => ['required', Rule::enum(YesOrNo::class)],
        ];
    }

    public function update(): void
    {
        $this->updatePermissions();
        $this->role->update([
            'name' => $this->name,
            'guard_name' => 'web',
            'unique' => YesOrNo::from($this->unique)->toBoolean(),
        ]);

    }

    public function save(): void
    {
        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
            'unique' => YesOrNo::from($this->unique)->toBoolean(),
        ]);

        $this->createPermissions($role);
    }
}
