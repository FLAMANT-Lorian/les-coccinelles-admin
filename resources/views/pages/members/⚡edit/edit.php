<?php

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('page-title.members-edit')]
class extends Component {
    public User $member;
    public function mount(User $member): void
    {
        if ($member->roles()->first()->name === config('permission.super_admin_name')) {
            abort(403);
        }

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
