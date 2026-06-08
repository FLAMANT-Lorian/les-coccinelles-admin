<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('page-title.messages')]
class extends Component {

    public bool $modalDeleteAll = false;
    public bool $modalViewMessage = false;
    public bool $modalDeleteMessage = false;
    public Message $messageToSee;
    public ?int $messageToDelete;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteSelection') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'viewMessage') {
            $message = Message::findOrFail($id);

            if (!$message) return;

            $this->messageToSee = $message;

            $this->modalViewMessage = true;
        } elseif ($modal === 'deleteMessage') {
            $this->messageToDelete = $id;

            $this->modalDeleteMessage = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
        $this->modalViewMessage = false;
        $this->modalDeleteMessage = false;
    }
};
