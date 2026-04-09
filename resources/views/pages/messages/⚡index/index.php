<?php

use App\Enums\MessageTypes;
use App\Traits\SetActiveTab;
use Livewire\Component;

new class extends Component {

    use SetActiveTab;

    public function mount(): void
    {
        $this->tab = MessageTypes::contact->value;
    }
};
