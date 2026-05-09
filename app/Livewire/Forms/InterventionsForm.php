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
            'description' => '',
            'assignee' => 'required|exists:users,id',
            'status' => ['required', Rule::enum(InterventionStatus::class)],
            'deadline' => 'required|date',
        ];
    }

    public function setIntervention(Intervention $intervention): void
    {
        $this->intervention = $intervention;

        $this->name = $intervention->name;
        $this->description = $intervention->description;
        $this->status = $intervention->status;
        $this->assignee = $intervention->assignee->id ?? null;
        $this->deadline = $intervention->deadline->format('Y-m-d');
    }

    public function update(): void
    {
        $assignee = User::findOrFail($this->assignee);

        $this->intervention->update([
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'created_by' => auth()->user()->id,
            'assigned_to' => $assignee->id,
        ]);
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
