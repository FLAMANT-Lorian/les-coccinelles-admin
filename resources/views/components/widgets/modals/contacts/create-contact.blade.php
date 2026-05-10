<x-widgets.modals.modal-layout
    :title="__('modals.addContact')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="save" novalidate class="flex flex-col">

        <x-pages.contacts.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.createContact')"
        />
    </form>
</x-widgets.modals.modal-layout>
