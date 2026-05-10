<x-widgets.modals.modal-layout
    :title="__('modals.updateContact')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="update" novalidate class="flex flex-col">

        <x-pages.contacts.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateContact')"
        />
    </form>
</x-widgets.modals.modal-layout>
