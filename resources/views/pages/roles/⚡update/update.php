<?php

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component {
    public Role $role;

    public function mount(Role $role): void
    {
        $this->role = $role;
    }

    public bool $modalDeleteRole = false;
    public ?int $roleToDelete = null;


    #[On('open-modal')]
    public function openModal(string $modal, string $id = null): void
    {
        if ($modal === 'deleteRole') {
            $this->modalDeleteRole = true;
            $this->roleToDelete = $id;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteRole = false;
    }
};
