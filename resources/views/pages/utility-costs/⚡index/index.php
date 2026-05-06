<?php

use App\Enums\UtilityCostsStatus;
use App\Livewire\Forms\UtilityCostsForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public UtilityCostsForm $form;
    public array $terms = [
        'status' => ''
    ];

    public bool $createUtilityCostModalOpen = false;

    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        if ($modal == 'createUtilityCost') {
            $this->createUtilityCostModalOpen = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->createUtilityCostModalOpen = false;
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
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.utility-cost-created'));

        $this->redirectRoute('utility-costs', ['locale' => app()->getLocale()], navigate: true);
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.utility-cost-updated'));

        $this->redirectRoute('utility-costs', ['locale' => app()->getLocale()], navigate: true);
    }
};
