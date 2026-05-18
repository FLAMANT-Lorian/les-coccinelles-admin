<?php

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Livewire\Forms\MembersForm;
use App\Livewire\Forms\SettingsForm;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteMember;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use DeleteMember;
    use WithFileUploads;

    public bool $sexSelectState = false;

    public User $user;

    public SettingsForm $form;

    public function mount(): void
    {
        $this->user = auth()->user();

        $this->form->setUser($this->user);
    }

    public array $terms = [
        'sex' => '',
    ];

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

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.settings-updated'));

        $this->redirectRoute('settings', navigate: true);
    }

    #[On('remove-card')]
    public function removeCard($id): void
    {
        unset($this->form->documents[$id]);
    }
};
?>

<div>
    <h3 class="text-2xl font-medium mb-1">{{ __('pages/settings.settings.your-infos') }}</h3>
    <p class="paragraph text-gray-500 mb-6">{!! __('forms.accessibility_text') !!}</p>
    <form wire:submit.prevent="update" novalidate>
        <div class="grid-default border-b border-beige-dark/60 pb-10">
            {{-- PICTURE --}}
            <x-pages.settings.settings.forms.fieldset1/>

            <span aria-hidden="true" class="col-span-1 justify-self-center h-full w-px bg-beige-dark/60"></span>

            {{-- BASE --}}
            <x-pages.settings.settings.forms.fieldset2/>

        </div>

        {{-- DOCUMENTS --}}
        <x-pages.settings.settings.forms.fieldset3
            class="border-none"/>

        {{-- BOUTON --}}
        <x-forms.buttons.submit-filled
            :label="__('forms.save-changes')"
        />
    </form>
</div>
