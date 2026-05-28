<?php

namespace App\Traits;

use App\Livewire\Forms\TasksForm;
use App\Models\Event;
use Livewire\Attributes\On;


/**
 * @property Event $event
 */
trait HandleTasks
{
    public TasksForm $tasksForm;

    public function saveTask(): void
    {
        $this->tasksForm->validate();

        $this->tasksForm->save($this->event);

        session()->flash('success', __('flash-messages.task-created'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    public function updateTask(): void
    {
        //
    }

    #[On('delete-task')]
    public function deleteTask(int $id): void
    {
        //
    }
}
