<?php

use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('page-title.members')]
class extends Component {
    public bool $modalDeleteAll = false;
    public bool $modalDeleteMember = false;
    public ?int $memberToDelete = null;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteSelection') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'deleteMember') {
            $this->modalDeleteMember = true;
            $this->memberToDelete = $id;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
        $this->modalDeleteMember = false;
    }
};
