<x-widgets.modals.modal-layout
    :title="__('modals.createHallRate')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="save" novalidate class="flex flex-col">

        <x-pages.hall-rates.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.createHallRate')"
        />
    </form>
</x-widgets.modals.modal-layout>
