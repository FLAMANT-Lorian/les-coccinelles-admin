<?php

use App\Livewire\Forms\MeetingsForm;
use App\Models\Meeting;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public bool $openCreateModal = false;
    public bool $openEditModal = false;
    public bool $openDeleteModal = false;
    public bool $deleteSelection = false;

    public MeetingsForm $form;

    public ?Meeting $meeting = null;

    public function mount(): void
    {
        if (request()->boolean('create')) {
            $this->openModal('openCreateModal');
        } elseif ($id = request()->query('meeting')) {
            $this->openModal('openEditModal', $id);
        }
    }
    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($id) {
            $this->meeting = Meeting::findOrFail($id);
        }

        $this->dispatch('init-date-pickers');

        if ($modal === 'openCreateModal') {
            $this->openCreateModal = true;
        } elseif ($modal === 'openEditModal') {
            $this->form->setMeeting($this->meeting);
            $this->dispatch('init-fancybox');
            $this->openEditModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'deleteSelection') {
            $this->deleteSelection = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->openCreateModal = false;
        $this->openEditModal = false;
        $this->openDeleteModal = false;
        $this->deleteSelection = false;
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
        $this->authorize('create', Meeting::class);

        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.meeting-created'));

        $this->redirectRoute('meetings', navigate: true);
    }

    public function update(): void
    {
        $this->authorize('update', Meeting::class);

        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.meeting-updated'));

        $this->redirectRoute('meetings', navigate: true);
    }

    #[On('delete-meeting')]
    public function deleteMeeting(): void
    {
        $this->authorize('delete', Meeting::class);

        if ($this->meeting->file) {
            $disk = config('filesystems.default');
            $path = config('meetings.original_path') . '/' . $this->meeting->file;

            if ($this->meeting->file && Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }

        $this->meeting->delete();

        session()->flash('success', __('flash-messages.meeting-deleted'));

        $this->redirectRoute('meetings', navigate: true);
    }
};
