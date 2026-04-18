<?php

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Livewire\Forms\CreateMembersForm;
use App\Models\Role;
use App\Models\User;
use App\Traits\SelectMultiple;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public CreateMembersForm $form;

    public array $terms = [
        'sex' => '',
        'role' => '',
        'status' => ''
    ];

    #[Computed]
    public function getRoles()
    {
        $query = Role::query();

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
        $this->form->validate();

        $this->form->save();
    }
};
?>

<form wire:submit="save">
    <div class="grid-default border-b border-beige-dark/60 pb-10">
        {{-- PICTURE --}}
        <x-pages.members.members.forms.create.fieldset1/>

        <span aria-hidden="true" class="col-span-1 justify-self-center h-full w-px bg-beige-dark/60"></span>

        {{-- BASE --}}
        <x-pages.members.members.forms.create.fieldset2/>
    </div>

    {{-- DOCUMENTS --}}
    <x-pages.members.members.forms.create.fieldset3/>

    {{-- MOT DE PASSE --}}
    <x-pages.members.members.forms.create.fieldset4/>

    {{-- BOUTON --}}
    <x-forms.buttons.submit-filled
        :label="__('pages/members.create-members')"
    />
</form>
