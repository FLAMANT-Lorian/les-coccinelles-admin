<?php

use App\Enums\YesOrNo;
use App\Livewire\Forms\ContactsForm;
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

    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'openCreateModal') {
            $this->openCreateModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->openCreateModal = false;
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
};
