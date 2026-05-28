<x-widgets.modals.modal-layout
    :title="__('modals.addFolder')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="saveFolder" novalidate class="flex flex-col">

        <x-pages.events.forms.folders.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.createFolder')"
        />
    </form>
</x-widgets.modals.modal-layout>
