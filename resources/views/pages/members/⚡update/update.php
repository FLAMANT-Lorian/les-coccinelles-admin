<?php

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public User $member;
    public function mount($member): void
    {
        $this->member = $member;
    }

    public bool $modalDeleteMember = false;
    public ?int $memberToDelete = null;


    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        if ($modal === 'deleteMember') {
            $this->modalDeleteMember = true;
            $this->memberToDelete = $this->member->id;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteMember = false;
    }
};
