<?php

use App\Enums\InterventionStatus;
use App\Livewire\Forms\InterventionsForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
    public bool $openCreateModal = false;

    public InterventionsForm $form;

    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        if ($modal === 'openCreateModal') {
            if (method_exists($this, 'resetTableFilters')) {
                $this->resetTableFilters();
            }
            $this->openCreateModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openCreateModal = false;
    }

    #[Computed]
    public function getMembers()
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

    public function save()
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.intervention-created'));

        $this->redirectRoute('interventions', navigate: true);
    }
};
