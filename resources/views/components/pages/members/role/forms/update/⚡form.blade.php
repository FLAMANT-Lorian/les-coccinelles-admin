<?php

use App\Enums\YesOrNo;
use App\Livewire\Forms\RoleForm;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component {

    public RoleForm $form;

    public array $terms = [
        'unique' => '',
    ];

    public function mount(Role $role): void
    {
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
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.role-updated'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale(), 'tab' => 'roles']);
    }
};
?>

<form wire:submit.live="update" novalidate>
    <div>
        {{-- BASE --}}
        <x-pages.members.role.forms.fieldset1/>

        {{-- PERMISSIONS --}}
        <x-pages.members.role.forms.fieldset2/>
    </div>

    <x-forms.buttons.submit-filled
        class="mt-8 normal-case!"
        :label="__('forms.save-changes')"
    />
</form>
