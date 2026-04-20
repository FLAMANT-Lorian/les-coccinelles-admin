<?php

use App\Enums\YesOrNo;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public array $terms = [
        'unique' => '',
    ];

    public array $membersOptions = [];

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
};
?>

<form>
    <div>
        {{-- BASE --}}
        <x-pages.members.role.forms.create.fieldset1/>

        {{-- PERMISSIONS --}}
        <x-pages.members.role.forms.create.fieldset2/>
    </div>

    <x-forms.buttons.submit-filled
        class="mt-8 normal-case!"
        :label="__('forms.add_role')"
    />
</form>
