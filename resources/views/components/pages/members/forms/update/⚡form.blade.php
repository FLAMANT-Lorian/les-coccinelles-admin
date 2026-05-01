<?php

use App\Enums\MembersStatus;
use App\Enums\Sex;
use App\Livewire\Forms\MembersForm;
use App\Models\User;
use App\Traits\DeleteMember;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

new class extends Component {

    use DeleteMember;
    use WithFileUploads;

    public MembersForm $form;
    public User $member;

    public function mount($member): void
    {
        $this->member = $member;
        $this->form->setMember($member);
    }

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
                        ->whereDoesntHave('users')
                        ->orWhereHas('users', function ($q) {
                            $q->where('id', $this->member->id);
                        });
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

    public function update(): void
    {
        $this->form->validate();

        $this->form->update();

        session()->flash('success', __('flash-messages.member-updated'));

        $this->redirectRoute('members.index', ['locale' => app()->getLocale()], navigate: true);
    }

    #[On('remove-avatar')]
    public function removeAvatar(): void
    {
        $path = config('avatar.original_path') . $this->member->avatar_path;

        if (Storage::disk(config('filesystems.default'))->exists($path)) {
            Storage::disk(config('filesystems.default'))->delete($path);
        }
    }
};
?>

<form wire:submit.prevent="update" novalidate>
    <div class="grid-default border-b border-beige-dark/60 pb-10">
        {{-- PICTURE --}}
        <x-pages.members.forms.fieldset1/>

        <span aria-hidden="true" class="col-span-1 justify-self-center h-full w-px bg-beige-dark/60"></span>

        {{-- BASE --}}
        <x-pages.members.forms.fieldset2/>
    </div>

    {{-- DOCUMENTS --}}
    <x-pages.members.forms.fieldset3
            class="border-none"/>

    {{-- BOUTON --}}
    <x-forms.buttons.submit-filled
            :label="__('forms.save-changes')"
    />
</form>
