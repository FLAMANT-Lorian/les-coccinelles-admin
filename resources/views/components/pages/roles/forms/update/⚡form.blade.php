<?php

use App\Enums\YesOrNo;
use App\Livewire\Forms\RoleForm;
use App\Traits\DeleteRole;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component {

    use DeleteRole;

    public RoleForm $form;

    public Role $role;

    public bool $uniqueSelectState = false;

    public array $terms = [
        'unique' => '',
    ];

    public function mount(Role $role): void
    {
        $this->role = $role->load('users');
        $this->form->setRole($role);
    }

    #[Computed]
    public function getYesOrNo()
    {
        $cases = YesOrNO::cases();

        if (!empty($this->terms['unique'])) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->terms['unique'])
                );
            });
        }
        return $cases;
    }

    public function update(): void
    {
        $this->authorize('update', Role::class);

        $this->form->validate();

        $usersCount = $this->role->users()->count();

        if ($usersCount > 1 && $this->form->unique === YesOrNo::YES->value) {
            session()->flash('error', __('flash-messages.role-cant-be-unique', ['count' => $usersCount]));

            $this->redirectRoute('roles.update', ['role' => $this->role], navigate: true);
            return;
        }

        $this->form->update();

        session()->flash('success', __('flash-messages.role-updated'));

        $this->redirectRoute('roles.index', navigate: true);
    }
};
?>

<form wire:submit.live="update" novalidate>
    <div>
        {{-- BASE --}}
        <x-pages.roles.forms.fieldset1/>

        {{-- PERMISSIONS --}}
        <x-pages.roles.forms.fieldset2/>
    </div>

    <x-forms.buttons.submit-filled
        class="mt-8 normal-case!"
        :label="__('forms.save-changes')"
    />
</form>
