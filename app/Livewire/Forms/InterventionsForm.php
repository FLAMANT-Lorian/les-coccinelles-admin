<?php

namespace App\Livewire\Forms;

use App\Enums\InterventionStatus;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class InterventionsForm extends Form
{
    public ?Intervention $intervention = null;

    public ?string $name = null;
    public ?string $description = null;
    public ?string $status = null;
    public ?int $assignee = null;
    public ?string $deadline = null;

    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'assignee' => 'required|exists:users,id',
            'status' => ['required', Rule::enum(InterventionStatus::class)],
            'deadline' => 'required|date',
        ];
    }

    public function setIntervention($intervention): void
    {
        $this->intervention = $intervention;
    }

    public function update(): void
    {

    }

    public function save(): void
    {
        $assignee = User::findOrFail($this->assignee);

       auth()->user()->createdInterventions()->create([
           'name' => $this->name,
           'description' => $this->description,
           'status' => $this->status,
           'deadline' => $this->deadline,
           'assigned_to' => $assignee->id,
       ]);
    }
}
