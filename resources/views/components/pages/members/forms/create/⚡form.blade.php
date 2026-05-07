<?php

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Livewire\Forms\MembersForm;
use App\Models\User;
use App\Traits\CleanLivewireTMPFolder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

new class extends Component {

    use WithFileUploads;
    use CleanLivewireTMPFolder;

    public MembersForm $form;

    public array $terms = [
        'sex' => '',
        'role' => '',
        'status' => ''
    ];

    #[Computed]
    public function getRoles()
    {
        $query = Role::query();

        $query->where(function ($q) {
            $q->where('unique', false)
                ->orWhere(function ($q) {
                    $q->where('unique', true)
                        ->whereDoesntHave('users');
                });
        });

        if (!empty($this->terms['role'])) {
            $query = $query->whereLike('name', '%' . $this->terms['role'] . '%');
        }

        $roles = $query->get();

        return $roles->isEmpty() ? [] : $roles;
    }

    #[Computed]
    public function getSex()
    {
        $cases = Sex::cases();

        if (!empty($this->terms['sex'])) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->terms['sex'])
                );
            });
        }
        return $cases;
    }

    #[Computed]
    public function getStatus()
    {
        $cases = MembersStatus::cases();

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
        $this->authorize('create', User::class);

        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.member-created'));

        $this->redirectRoute('members.index', navigate: true);
    }

    #[On('remove-avatar')]
    public function removeAvatar(): void
    {
        $this->form->avatar = null;
        $this->cleanLivewireTMPFolder();
    }

    #[On('remove-card')]
    public function removeCard($id): void
    {
        unset($this->form->documents[$id]);
    }
};
?>

<form wire:submit.prevent="save" novalidate>
    <div class="grid-default border-b border-beige-dark/60 pb-10">
        {{-- PICTURE --}}
        <x-pages.members.forms.fieldset1/>

        <span aria-hidden="true" class="col-span-1 justify-self-center h-full w-px bg-beige-dark/60"></span>

        {{-- BASE --}}
        <x-pages.members.forms.fieldset2/>
    </div>

    {{-- DOCUMENTS --}}
    <x-pages.members.forms.fieldset3/>

    {{-- MOT DE PASSE --}}
    <x-pages.members.forms.fieldset4/>

    {{-- BOUTON --}}
    <x-forms.buttons.submit-filled
        :label="__('pages/members.create-members')"
    />
</form>
