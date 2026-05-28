<?php

namespace App\Livewire\Forms;

use App\Enums\YesOrNo;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class TasksForm extends Form
{
    public ?Task $task = null;
    public ?string $name = null;
    public ?int $assignee = null;

    public function rules(): array
    {
        return [
           'name' => 'required',
            'assignee' => 'required|exists:users,id'
        ];
    }

    public function setTask(Task $task): void
    {
        //
    }

    public function update(): void
    {
       //
    }

    public function save(Event $event): void
    {
        $assignee = User::findOrFail($this->assignee);

       $event->tasks()->create([
           'name' => $this->name,
           'assigned_to' => $assignee->id,
           'completed' => 0
       ]);
    }
}
