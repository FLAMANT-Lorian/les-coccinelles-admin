<?php

use App\Livewire\Forms\EventsForm;
use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use App\Traits\DeleteEvent;
use App\Traits\HandleFiles;
use App\Traits\HandleFolder;
use App\Traits\HandleTasks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Event;
use Livewire\WithFileUploads;

new #[Title('page-title.events-show')]
class extends Component {
    use WithFileUploads;
    use DeleteEvent;
    use HandleFolder;
    use HandleFiles;
    use HandleTasks;

    public Event $event;
    public EventsForm $form;

    public function mount(Event $event): void
    {
        $this->event = $event;
    }

    public bool $openEditModal = false;
    public bool $openDeleteModal = false;
    public bool $openCreateFolderModal = false;
    public bool $openUpdateFolderModal = false;
    public bool $openDeleteFolderModal = false;
    public ?Folder $folder = null;
    public bool $openFolderModal = false;

    public bool $openCreateTaskModal = false;
    public bool $openUpdateTaskModal = false;
    public bool $openDeleteTaskModal = false;
    public ?Task $task = null;

    #[On('open-modal')]
    public function openModal(string $modal, int $folder_id = null, int $task_id = null): void
    {
        $this->dispatch('init-date-pickers');

        if ($folder_id) {
            $this->folder = $this->event->folders()->findOrFail($folder_id);
        }

        if ($task_id) {
            $this->task = $this->event->tasks()->findOrFail($task_id);
        }

        if ($modal === 'openEditModal') {
            $this->form->setEvent($this->event);
            $this->openEditModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'openCreateFolderModal') {
            $this->openCreateFolderModal = true;
        } elseif ($modal === 'openUpdateFolderModal') {
            $this->foldersForm->setFolder($this->folder);
            $this->openUpdateFolderModal = true;
        } elseif ($modal === 'openDeleteFolderModal') {
            $this->openDeleteFolderModal = true;
        } elseif ($modal === 'openFolderModal') {
            $this->dispatch('init-fancybox');
            $this->openFolderModal = true;
        } elseif ($modal === 'openCreateTaskModal') {
            $this->openCreateTaskModal = true;
        } elseif ($modal === 'openUpdateTaskModal') {
            $this->tasksForm->setTask($this->task);
            $this->openUpdateTaskModal = true;
        } elseif ($modal === 'openDeleteTaskModal') {
            $this->openDeleteTaskModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        // EVENT
        $this->openEditModal = false;
        $this->openDeleteModal = false;

        // FOLDERS
        $this->openFolderModal = false;
        $this->openCreateFolderModal = false;
        $this->openUpdateFolderModal = false;
        $this->openDeleteFolderModal = false;

        // TASKS
        $this->openCreateTaskModal = false;
        $this->openUpdateTaskModal = false;
        $this->openDeleteTaskModal = false;
    }

    public function update(): void
    {
        $this->authorize('update', Event::class);

        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.event-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    public bool $openAssigneeSelectState = false;
    public array $terms = [
        'assignee' => '',
        'status' => '',
    ];

    #[Computed]
    public function getMembers(): Collection|array
    {
        $query = User::query();

        if (!empty($this->terms['assignee'])) {
            $query->where(function (Builder $q) {
                $q->whereLike('first_name', '%' . $this->terms['assignee'] . '%');
            });
        }

        // RETIRER SUPER ADMIN
        $query->whereDoesntHave('roles', function (Builder $q) {
            $q->where('name', config('permission.super_admin_name'));
        });

        $members = $query->get();

        return $members->isEmpty() ? [] : $members;
    }
};
