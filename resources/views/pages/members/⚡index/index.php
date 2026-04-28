<?php


use App\Traits\SetActiveTab;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    use SetActiveTab;

    public function mount(): void
    {
        $allowedTabs = ['roles', 'members'];

        $this->checkAllowedTabs($allowedTabs, 'members');
    }

    public bool $modalDeleteAll = false;
    public bool $modalDeleteMember = false;
    public ?int $memberToDelete = null;
    public bool $modalDeleteRole = false;
    public ?int $roleToDelete = null;
    public bool $modalDeleteAllRoles = false;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteAll') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'deleteMember') {
            $this->modalDeleteMember = true;
            $this->memberToDelete = $id;
        } elseif ($modal === 'deleteRole') {
            $this->modalDeleteRole = true;
            $this->roleToDelete = $id;
        } elseif ($modal === 'deleteAllRoles') {
            $this->modalDeleteAllRoles = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
        $this->modalDeleteMember = false;
        $this->modalDeleteRole = false;
        $this->modalDeleteAllRoles = false;
    }
};
