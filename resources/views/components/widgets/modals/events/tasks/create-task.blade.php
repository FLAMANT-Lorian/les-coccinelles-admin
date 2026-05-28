<x-widgets.modals.modal-layout
    :overflow="false"
    :title="__('modals.addTask')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="saveTask" novalidate class="flex flex-col">

        <x-pages.events.forms.tasks.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.createTask')"
        />
    </form>
</x-widgets.modals.modal-layout>
