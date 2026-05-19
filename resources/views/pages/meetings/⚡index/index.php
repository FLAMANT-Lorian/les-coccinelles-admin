<?php

use App\Livewire\Forms\MeetingsForm;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public bool $openCreateModal = false;

    public MeetingsForm $form;

    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        $this->dispatch('init-date-pickers');

        if ($modal == 'openCreateModal') {
            $this->openCreateModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openCreateModal = false;
    }

    #[On('remove-file')]
    public function removeFile(): void
    {
        $this->form->file = null;
    }

    public function save(): void
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.meeting-created'));

        $this->redirectRoute('meetings', navigate: true);
    }
};
