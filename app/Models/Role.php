<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = [
        'name',
        'guard_name',
        'unique'
    ];

    /**
     * Remove super-admin
     */
    #[Scope]
    protected function removeSuperAdmin(Builder $query): void
    {
        $query->where('name', '!=', config('permission.super_admin_name'));
    }
}
