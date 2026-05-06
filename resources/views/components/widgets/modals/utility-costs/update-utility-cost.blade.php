<x-widgets.modals.modal-layout
    :title="__('modals.updateUtilityCost')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="update" novalidate class="flex flex-col">

        <x-pages.utility-costs.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateUtilityCost')"
        />
    </form>
</x-widgets.modals.modal-layout>
