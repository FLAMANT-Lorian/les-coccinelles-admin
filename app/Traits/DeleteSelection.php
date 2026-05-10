<?php

namespace App\Traits;

use App\Models\AvailabilityRequest;
use App\Models\Contact;
use App\Models\HallRate;
use App\Models\Intervention;
use App\Models\Message;
use App\Models\User;
use App\Models\UtilityCost;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

trait DeleteSelection
{
    use HandleImages;

    public array $selectedColumn = [];

    #[On('deleteMessages')]
    public function deleteMessages(): void
    {
        $this->authorize('delete', Message::class);

        $messages = Message::whereIn('id', $this->selectedColumn)->get();

        foreach ($messages as $message) {
            $message->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.messages-deleted'));

        $this->redirectRoute('messages', navigate: true);
    }

    #[On('deleteMembers')]
    public function deleteMembers(): void
    {
        $this->authorize('delete', User::class);

        $members = User::whereIn('id', $this->selectedColumn)->get();

        foreach ($members as $member) {
            if ($member->avatar_path) {
                $this->removeOldAvatar($member->id);
            }

            if ($member->documents) {
                foreach ($member->documents as $document) {
                    $this->removeOldDocument($document);
                }
            }
            $member->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.members-deleted'));

        $this->redirectRoute('members.index', navigate: true);
    }

    #[On('deleteAllRoles')]
    public function deleteRoles(): void
    {
        $this->authorize('delete', Role::class);

        $hasUsers = false;

        $roles = Role::whereIn('id', $this->selectedColumn)->get();

        foreach ($roles as $role) {
            $users = $role->users()->count();

            if ($users > 0) {
                $hasUsers = true;
                break;
            }
        }

        if ($hasUsers) {

            session()->flash('error', __('flash-messages.roles-cant-be-deleted', ['count' => $users]));

            $this->redirectRoute('roles.index', navigate: true);
            return;
        }

        foreach ($roles as $role) {
            $role->delete();

            session()->flash('success', __('flash-messages.roles-deleted'));

            $this->redirectRoute('roles.index', navigate: true);
        }
    }

    #[On('deleteAvailabilityRequests')]
    public function deleteAvailabilityRequests(): void
    {
        $this->authorize('delete', AvailabilityRequest::class);

        $availabilityRequests = AvailabilityRequest::whereIn('id', $this->selectedColumn)->get();

        foreach ($availabilityRequests as $availabilityRequest) {
            $availabilityRequest->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.availability-requests-deleted'));

        $this->redirectRoute('availabilities', navigate: true);
    }

    #[On('deleteHallRates')]
    public function deleteHallRates(): void
    {
        $this->authorize('delete', HallRate::class);

        $hallRates = HallRate::whereIn('id', $this->selectedColumn)->get();

        foreach ($hallRates as $hallRate) {
            $hallRate->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.hall-rates-deleted'));

        $this->redirectRoute('hall-rates', navigate: true);
    }

    #[On('deleteUtilityCosts')]
    public function deleteUtilityCosts(): void
    {
        $this->authorize('delete', UtilityCost::class);

        $utilityCosts = UtilityCost::whereIn('id', $this->selectedColumn)->get();

        foreach ($utilityCosts as $utilityCost) {
            $utilityCost->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.utility-costs-deleted'));

        $this->redirectRoute('utility-costs', navigate: true);
    }

    #[On('deleteInterventions')]
    public function deleteInterventions(): void
    {
        $this->authorize('delete', Intervention::class);

        $interventions = Intervention::whereIn('id', $this->selectedColumn)->get();

        foreach ($interventions as $intervention) {
            $intervention->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.interventions-deleted'));

        $this->redirectRoute('interventions', navigate: true);
    }

    #[On('deleteContacts')]
    public function deleteContacts(): void
    {
        $contacts = Contact::whereIn('id', $this->selectedColumn)->get();

        foreach ($contacts as $contact) {
            $contact->delete();
        }

        $this->selectedColumn = [];

        session()->flash('success', __('flash-messages.contacts-deleted'));

        $this->redirectRoute('contacts', navigate: true);
    }
}
