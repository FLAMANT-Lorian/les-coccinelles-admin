<?php

namespace App\Traits;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait CustomPermissions
{
    public array $permissions = [
        'messages' => [
            'index' => false,
            'delete' => false,
        ]
    ];

    public function setPermissions(): void
    {
        $permissions = [];

        foreach ($this->role->permissions as $permission) {
            $parts = explode('.', $permission->name);

            if (count($parts) === 2) {
                $permissions[$parts[0]][$parts[1]] = true;
            }
        }

        $this->permissions = $permissions;
    }

    public function createPermissions(Role $role): void
    {
        foreach ($this->permissions['messages'] as $key => $permission) {

            if ($permission) {
                $rule = 'messages.' . $key;
                $perm = Permission::where('name', $rule)->first();
                $role->givePermissionTo($perm);
            }
        }
    }

    public function updatePermissions(): void
    {
        foreach ($this->permissions['messages'] as $key => $permission) {
            $rule = 'messages.' . $key;
            $perm = Permission::where('name', $rule)->first();

            if ($permission) {
                if (!$this->role->hasPermissionTo($perm)) {
                    $this->role->givePermissionTo($perm);
                }
            } else {
                if ($this->role->hasPermissionTo($perm)) {
                    $this->role->revokePermissionTo($perm);
                }
            }
        }
    }
}
