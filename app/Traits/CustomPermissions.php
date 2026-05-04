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
            'update' => false,
        ],
        'members' => [
            'index' => false,
            'create' => false,
            'update' => false,
            'delete' => false,
        ],
        'roles' => [
            'index' => false,
            'create' => false,
            'update' => false,
            'delete' => false,
        ],
        'availabilities' => [
            'index' => false,
            'delete' => false,
            'update' => false,
        ]
    ];

    public function setPermissions(): void
    {
        $permissions = $this->permissions;

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
        foreach ($this->permissions as $key => $permissions) {
            foreach ($permissions as $action => $permission) {
                if ($permission) {
                    $rule = $key . '.' . $action;
                    $perm = Permission::where('name', $rule)->first();
                    $role->givePermissionTo($perm);
                }
            }
        }
    }

    public function updatePermissions(): void
    {
        foreach ($this->permissions as $key => $permissions) {
            foreach ($permissions as $action => $permission) {
                $rule = $key . '.' . $action;
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
}
