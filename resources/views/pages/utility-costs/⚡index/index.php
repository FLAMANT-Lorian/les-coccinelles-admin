<?php

use App\Enums\UtilityCostsStatus;
use App\Livewire\Forms\UtilityCostsForm;
use App\Models\UtilityCost;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public UtilityCostsForm $form;

    public bool $statusSelectState = false;

    public array $terms = [
        'status' => ''
    ];
    public bool $updateUtilityCostModalOpen = false;
    public UtilityCost $utilityCost;

    #[On('open-modal')]
    public function openModal(string $modal, $id = null): void
    {
        if ($id) {
            $this->utilityCost = UtilityCost::findOrFail($id);
        }

        if ($modal === 'updateUtilityCost') {
            $this->form->setUtilityCost($this->utilityCost);
            $this->updateUtilityCostModalOpen = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->updateUtilityCostModalOpen = false;
    }

    #[Computed]
    public function getStatus(): array
    {
        $cases = UtilityCostsStatus::cases();

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

    public function update(): void
    {
        $this->authorize('update', UtilityCost::class);

        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.utility-cost-updated'));

        $this->redirectRoute('utility-costs', navigate: true);
    }
};
