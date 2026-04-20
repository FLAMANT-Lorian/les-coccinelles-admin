<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $member;
    public function mount($member): void
    {
        $this->member = $member;
    }
};
