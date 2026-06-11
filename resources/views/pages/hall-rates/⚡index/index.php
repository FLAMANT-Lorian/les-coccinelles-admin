<?php

use App\Livewire\Forms\HallRatesForm;
use App\Models\HallRate;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('page-title.hall-rates')]
class extends Component {
    public HallRatesForm $form;
    public bool $createHallRateModalOpen = false;
    public bool $updateHallRateModalOpen = false;
    public bool $deleteHallRateModalOpen = false;
    public bool $deleteHallRatesModalOpen = false;
    public ?HallRate $hallRate = null;

    #[On('open-modal')]
    public function openModal($modal, $id = null): void
    {
        if ($id) {
            $this->hallRate = HallRate::findOrFail($id);
        }
        if ($modal === 'openCreateModal') {
            $this->createHallRateModalOpen = true;
        } elseif ($modal === 'openUpdateModal') {
            $this->form->setHallRate($this->hallRate);
            $this->updateHallRateModalOpen = true;
        } elseif ($modal === 'deleteHallRateModal') {
            $this->deleteHallRateModalOpen = true;
        } elseif ($modal === 'deleteSelection') {
            $this->deleteHallRatesModalOpen = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->createHallRateModalOpen = false;
        $this->updateHallRateModalOpen = false;
        $this->deleteHallRateModalOpen = false;
        $this->deleteHallRatesModalOpen = false;

        $this->form->reset();
        $this->form->resetErrorBag();
    }

    public function save(): void
    {
        $this->authorize('create', HallRate::class);

        $this->form->validate();

        $this->form->save();

        $this->closeModal();

        session()->flash('success', __('flash-messages.hall-rate-created'));


        $this->redirectRoute('hall-rates', navigate: true);
    }

    public function update(): void
    {
        $this->authorize('update', HallRate::class);

        $this->form->validate();

        $this->form->update();

        $this->closeModal();

        session()->flash('success', __('flash-messages.hall-rate-updated'));

        $this->redirectRoute('hall-rates', navigate: true);
    }
};
