<x-widgets.modals.modal-layout
    :title="__('modals.updateMeeting')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="update" novalidate class="flex flex-col">

        <x-pages.meetings.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateMeeting')"
        />
    </form>
</x-widgets.modals.modal-layout>
