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

    public function save(): void
    {
        $this->authorize('create', Role::class);

        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.role-created'));

        $this->redirectRoute('roles.index', ['locale' => app()->getLocale()]);
    }
};
?>

<form wire:submit.live="save" novalidate>
    <div>
        {{-- BASE --}}
        <x-pages.roles.forms.fieldset1/>

        {{-- PERMISSIONS --}}
        <x-pages.roles.forms.fieldset2/>
    </div>

    <x-forms.buttons.submit-filled
        class="mt-8 normal-case!"
        :label="__('forms.add_role')"
    />
</form>
