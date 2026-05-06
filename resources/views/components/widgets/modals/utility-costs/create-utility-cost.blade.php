<x-widgets.modals.modal-layout
    :title="__('modals.addUtilityCost')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="save" novalidate class="flex flex-col">

        <x-pages.utility-costs.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.createUtilityCost')"
        />
    </form>
</x-widgets.modals.modal-layout>
