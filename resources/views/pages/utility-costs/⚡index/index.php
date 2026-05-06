<?php

use App\Enums\UtilityCostsStatus;
use App\Livewire\Forms\UtilityCostsForm;
use App\Models\UtilityCost;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public UtilityCostsForm $form;
    public array $terms = [
        'status' => ''
    ];

    public bool $createUtilityCostModalOpen = false;
    public bool $updateUtilityCostModalOpen = false;
    public bool $deleteUtilityCostModalOpen = false;
    public bool $deleteSelectionModalOpen = false;
    public UtilityCost $utilityCost;

    #[On('open-modal')]
    public function openModal(string $modal, $id = null): void
    {
        if ($id) {
            $this->utilityCost = UtilityCost::findOrFail($id);
        }

        if ($modal === 'createUtilityCost') {
            $this->createUtilityCostModalOpen = true;
        } elseif ($modal === 'updateUtilityCost') {
            $this->form->setUtilityCost($this->utilityCost);

            $this->updateUtilityCostModalOpen = true;
        } elseif ($modal === 'deleteUtilityCost') {
            $this->deleteUtilityCostModalOpen = true;
        } elseif ($modal === 'deleteSelection') {
            $this->deleteSelectionModalOpen = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();

        $this->createUtilityCostModalOpen = false;
        $this->updateUtilityCostModalOpen = false;
        $this->deleteUtilityCostModalOpen = false;
        $this->deleteSelectionModalOpen = false;
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

    public function save(): void
    {
        $this->authorize('create', UtilityCost::class);

        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.utility-cost-created'));

        $this->redirectRoute('utility-costs', ['locale' => app()->getLocale()], navigate: true);
    }

    public function update(): void
    {
        $this->authorize('update', UtilityCost::class);

        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.utility-cost-updated'));

        $this->redirectRoute('utility-costs', ['locale' => app()->getLocale()], navigate: true);
    }

    public function deleteUtilityCost(int $id): void
    {
        $this->authorize('delete', UtilityCost::class);

        $utilityCost = UtilityCost::findOrFail($id);

        $utilityCost->delete();

        session()->flash('success', __('flash-messages.utility-cost-deleted'));

        $this->redirectRoute('utility-costs', ['locale' => app()->getLocale()], navigate: true);
    }
};
