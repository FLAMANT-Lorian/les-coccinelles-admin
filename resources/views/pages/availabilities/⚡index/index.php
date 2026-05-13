<?php

use App\Enums\YesOrNo;
use App\Livewire\Forms\ContactsForm;
use App\Models\AvailabilityRequest;
use App\Models\Contact;
use App\Models\Message;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public bool $modalDeleteAll = false;
    public bool $modalViewAvailabilityRequest = false;
    public bool $modalDeleteAvailabilityRequest = false;
    public bool $openCreateContactModal = false;
    public AvailabilityRequest $availabilityRequestToSee;
    public ?int $availabilityRequestToDelete;

    public ContactsForm $form;

    public array $terms = [
        'member_card' => ''
    ];

    public bool $openMemberCardSelectState = false;


    #[On('open-modal')]
    public function openModal(string $modal, int $id = null): void
    {
        if ($modal === 'deleteSelection') {
            $this->modalDeleteAll = true;
        } elseif ($modal === 'viewAvailabilityRequest') {
            $availabilityRequest = AvailabilityRequest::findOrFail($id);

            $this->availabilityRequestToSee = $availabilityRequest;

            $this->modalViewAvailabilityRequest = true;
        } elseif ($modal === 'deleteAvailabilityRequest') {
            $this->availabilityRequestToDelete = $id;

            $this->modalDeleteAvailabilityRequest = true;
        } else if ($modal === 'openCreateContactModal') {
            $this->closeModal();

            $this->setContactInformation($id);

            $this->openCreateContactModal = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->form->reset();
        $this->form->resetErrorBag();

        $this->modalDeleteAll = false;
        $this->modalViewAvailabilityRequest = false;
        $this->modalDeleteAvailabilityRequest = false;
        $this->openCreateContactModal = false;
    }

    public function setContactInformation(int $id): void
    {
        $availabilityRequest = AvailabilityRequest::findOrFail($id);

        $this->form->first_name = $availabilityRequest->first_name;
        $this->form->last_name = $availabilityRequest->last_name;
        $this->form->email = $availabilityRequest->email;
        $this->form->phone = $availabilityRequest->email;
        $this->form->member_card = null;
        $this->form->address = null;
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
        $this->authorize('create', Contact::class);

        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.contact-created'));

        $this->redirectRoute('availabilities', navigate: true);
    }
};
