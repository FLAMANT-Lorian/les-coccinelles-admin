<?php

use App\Enums\InterventionStatus;
use App\Livewire\Forms\InterventionsForm;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public bool $openAssigneeSelectState = false;
    public bool $openStatusSelectState = false;
    public array $terms = [
        'assignee' => '',
        'status' => '',
    ];

    public ?Intervention $intervention = null;

    public bool $openCreateModal = false;
    public bool $openUpdateModal = false;
    public bool $openDeleteModal = false;
    public bool $openDeleteSelectionModal = false;

    public InterventionsForm $form;

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($id) {
            $this->intervention = Intervention::findOrFail($id);
        }

        if ($modal === 'openCreateModal') {
            $this->openCreateModal = true;
        } elseif ($modal === 'openUpdateModal') {
            $this->form->setIntervention($this->intervention);
            $this->openUpdateModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'deleteSelection') {
            $this->openDeleteSelectionModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();

        $this->form->resetErrorBag();

        $this->openCreateModal = false;
        $this->openUpdateModal = false;
    }

    #[Computed]
    public function getMembers(): Collection|array
    {
        $query = User::query();

        if (!empty($this->terms['assignee'])) {
            $query->where(function (Builder $q) {
                $q->whereLike('first_name', '%' . $this->terms['assignee'] . '%');
            });
        }

        $members = $query->get();

        return $members->isEmpty() ? [] : $members;
    }

    #[Computed]
    public function getStatus(): array
    {
        $cases = InterventionStatus::cases();

        if (!empty($this->terms['status'])) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->terms['status'])
                );
            });
        }
        return $cases;
    }

    public function save(): void
    {
        $this->authorize('create', Intervention::class);

        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.intervention-created'));

        $this->redirectRoute('interventions', navigate: true);
    }

    public function update(): void
    {
        $this->authorize('update', Intervention::class);

        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.intervention-updated'));

        $this->redirectRoute('interventions', navigate: true);
    }

    #[On('delete-intervention')]
    public function deleteIntervention(): void
    {
        $this->authorize('delete', Intervention::class);

        $this->intervention->delete();

        session()->flash('success', __('flash-messages.intervention-deleted'));

        $this->intervention = null;

        $this->redirectRoute('interventions', navigate: true);
    }
};
