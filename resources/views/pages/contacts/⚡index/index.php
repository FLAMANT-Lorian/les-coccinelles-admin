<?php

use App\Enums\YesOrNo;
use App\Livewire\Forms\ContactsForm;
use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public ContactsForm $form;

    public bool $openMemberCardSelectState = false;

    public array $terms = [
        'member_card' => '',
    ];

    public bool $openCreateModal = false;
    public bool $openUpdateModal = false;
    public bool $openDeleteModal = false;
    public bool $deleteSelectionModal = false;

    public ?Contact $contact = null;

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($id) {
            $this->contact = Contact::findOrFail($id);
        }

        if ($modal === 'openCreateModal') {
            $this->openCreateModal = true;
        } elseif ($modal === 'openUpdateModal') {
            $this->form->setContact($this->contact);
            $this->openUpdateModal = true;
        } elseif ($modal === 'openDeleteModal') {
            $this->openDeleteModal = true;
        } elseif ($modal === 'deleteSelection') {
            $this->deleteSelectionModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->resetErrorBag();

        $this->openCreateModal = false;
        $this->openUpdateModal = false;
        $this->openDeleteModal = true;
        $this->deleteSelectionModal = false;
    }

    #[Computed]
    public function getYesOrNo(): array
    {
        $cases = YesOrNo::cases();

        if (!empty($this->terms['member_card'])) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->terms['member_card'])
                );
            });
        }
        return $cases;
    }

    public function save(): void
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.contact-created'));

        $this->redirectRoute('contacts', navigate: true);
    }

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.contact-updated'));

        $this->redirectRoute('contacts', navigate: true);
    }

    #[On('delete-contact')]
    public function delete(): void
    {
        $this->contact->delete();

        session()->flash('success', __('flash-messages.contact-deleted'));

        $this->contact = null;

        $this->redirectRoute('contacts', navigate: true);
    }
};
