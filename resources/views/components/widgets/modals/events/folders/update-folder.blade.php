<x-widgets.modals.modal-layout
    :title="__('modals.updateFolder')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="updateFolder" novalidate class="flex flex-col">

        <x-pages.events.forms.folders.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateFolder')"
        />
    </form>
</x-widgets.modals.modal-layout>
