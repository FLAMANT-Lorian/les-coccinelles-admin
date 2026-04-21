<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Spatie\Permission\Models\Role;

readonly class UniqueRole implements ValidationRule
{

    public function __construct(private ?User $member = null)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $role = Role::where('name', $value)->first();

        if (!$role || !$role->unique) return;

        $user_with_role = $role->users()->first();

        if (!$user_with_role) return;

        if ($this->member && $this->member->id === $user_with_role->id) {
            return;
        }

        $fail(__('forms.role-is-already-use'));
    }
}
