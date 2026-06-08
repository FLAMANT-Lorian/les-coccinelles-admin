<?php

use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('page-title.roles')]
class extends Component
{
    public bool $modalDeleteRole = false;
    public ?int $roleToDelete = null;
    public bool $modalDeleteAllRoles = false;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
       if ($modal === 'deleteRole') {
            $this->modalDeleteRole = true;
            $this->roleToDelete = $id;
        } elseif ($modal === 'deleteSelection') {
            $this->modalDeleteAllRoles = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteRole = false;
        $this->modalDeleteAllRoles = false;
    }
};
