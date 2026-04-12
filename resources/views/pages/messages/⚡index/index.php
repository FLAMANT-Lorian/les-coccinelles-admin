<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public bool $modalDeleteAll = false;
    public bool $modalViewMessage = false;
    public Message $messageToSee;


    #[On('openModal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteAll') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'viewMessage' && !is_null($id)) {
            $message = Message::findOrFail($id);

            if (!$message) return;

            $this->messageToSee = $message;

            $this->modalViewMessage = true;
        }
    }

    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
        $this->modalViewMessage = false;
    }
};
