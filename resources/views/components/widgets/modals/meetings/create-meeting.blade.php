<x-widgets.modals.modal-layout
    :title="__('modals.addMeeting')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="save" novalidate class="flex flex-col">

        <x-pages.meetings.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.createMeeting')"
        />
    </form>
</x-widgets.modals.modal-layout>
