<x-widgets.modals.modal-layout
    :title="__('modals.updateEvent')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="update" novalidate class="flex flex-col">

        <x-pages.events.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateEvent')"
        />
    </form>
</x-widgets.modals.modal-layout>
