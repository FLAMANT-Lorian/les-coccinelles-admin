<?php


use App\Livewire\Forms\ChangePasswordForm;
use Livewire\Component;

new class extends Component {

    public ChangePasswordForm $form;

    public function change_password(): void
    {
        $this->form->validate();

        $this->form->update();

        auth()->logout();

        $this->redirectRoute('settings', navigate: true);
    }
};
?>

<div class="mt-8 pt-8 border-t border-t-beige-dark/60">
    <h3 class="text-2xl font-medium mb-1">{{ __('pages/settings.settings.change-password') }}</h3>
    <p class="paragraph text-gray-500 mb-6">{!! __('pages/settings.settings.change-password-text') !!}</p>
    <form wire:submit.prevent="change_password" novalidate>
        <x-pages.settings.settings.forms.fieldset4/>

        {{-- BOUTON --}}
        <x-forms.buttons.submit-filled
            :label="__('forms.change-password')"
        />
    </form>
</div>
