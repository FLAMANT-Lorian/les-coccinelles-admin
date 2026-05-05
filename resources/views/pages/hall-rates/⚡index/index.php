<?php

use App\Livewire\Forms\HallRatesForm;
use App\Models\HallRate;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public HallRatesForm $form;
    public bool $createHallRateModalOpen = false;
    public bool $updateHallRateModalOpen = false;

    #[On('open-modal')]
    public function openModal($modal, $id = null): void
    {
        if ($modal === 'openCreateModal') {
            $this->createHallRateModalOpen = true;
        } elseif ($modal === 'openUpdateModal') {
            $hallRate = HallRate::findOrFail($id);

            $this->form->setHallRate($hallRate);
            $this->updateHallRateModalOpen = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->createHallRateModalOpen = false;
        $this->updateHallRateModalOpen = false;
    }

    public function save(): void
    {
        $this->form->validate();

        $this->form->save();

        $this->closeModal();

        session()->flash('success', __('flash-messages.hall-rate-created'));


        $this->redirectRoute('hall-rates', ['locale' => app()->getLocale()], navigate: true);
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        $this->closeModal();

        session()->flash('success', __('flash-messages.hall-rate-updated'));

        $this->redirectRoute('hall-rates', ['locale' => app()->getLocale()], navigate: true);
    }
};
