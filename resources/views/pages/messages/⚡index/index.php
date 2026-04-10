<?php

use App\Enums\MessageTypes;
use App\Traits\SetActiveTab;
use Livewire\Component;

new class extends Component {

    use SetActiveTab;

    public function mount(): void
    {
        $allowedTabs = array_map(
            static fn(MessageTypes $type) => $type->value,
            MessageTypes::cases(),
        );

        $this->checkAllowedTabs($allowedTabs, MessageTypes::contact->value);
    }
};
