<?php

use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component
{
    public Role $role;

    public function mount(Role $role): void
    {
        $this->role = $role;
    }
};
