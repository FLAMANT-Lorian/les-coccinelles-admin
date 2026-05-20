<?php

use App\Livewire\Forms\MeetingsForm;
use App\Models\Meeting;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public bool $openCreateModal = false;
    public bool $openEditModal = false;

    public MeetingsForm $form;

    public ?Meeting $meeting = null;

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($id) {
            $this->meeting = Meeting::findOrFail($id);
        }

        $this->dispatch('init-date-pickers');

        if ($modal === 'openCreateModal') {
            $this->openCreateModal = true;
        } else if ($modal === 'openEditModal') {
            $this->form->setMeeting($this->meeting);
            $this->dispatch('init-fancybox');
            $this->openEditModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->openCreateModal = false;
        $this->openEditModal = false;
    }

    #[On('remove-file')]
    public function removeFile(): void
    {
        $this->form->file = null;
    }

    #[On('delete-file')]
    public function deleteFile(): void
    {
        $path = config('meetings.original_path') . '/' . $this->meeting->file;
        $disk = config('filesystems.default');

        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);

            $this->meeting->update([
                'file' => null
            ]);
        }
    }

    public function save(): void
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.meeting-created'));

        $this->redirectRoute('meetings', navigate: true);
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.meeting-updated'));

        $this->redirectRoute('meetings', navigate: true);
    }
};
