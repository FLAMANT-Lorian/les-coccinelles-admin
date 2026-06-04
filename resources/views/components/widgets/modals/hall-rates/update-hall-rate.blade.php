<x-widgets.modals.modal-layout
    :title="__('modals.updateHallRate')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="update" novalidate class="flex flex-col">

        <x-pages.hall-rates.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateHallRate')"
        />
    </form>
</x-widgets.modals.modal-layout>
