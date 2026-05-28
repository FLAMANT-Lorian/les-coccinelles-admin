<?php

namespace App\Traits;

use App\Livewire\Forms\TasksForm;
use App\Models\Event;
use App\Models\Task;
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
        $this->tasksForm->validate();

        $this->tasksForm->update();

        session()->flash('success', __('flash-messages.task-updated'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }

    #[On('delete-task')]
    public function deleteTask(int $id): void
    {
        $task = Task::findOrFail($id);

        $task->delete();

        session()->flash('success', __('flash-messages.task-deleted'));

        $this->redirectRoute('events.show', ['event' => $this->event->id], navigate: true);
    }
}
