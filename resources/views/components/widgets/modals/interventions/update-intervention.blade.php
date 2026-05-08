<x-widgets.modals.modal-layout
    :title="__('modals.updateIntervention')"
    :message="__('forms.accessibility_text')">
    <form wire:submit.prevent="update" novalidate class="flex flex-col">

        <x-pages.interventions.forms.fieldset-1/>

        <x-forms.buttons.submit-filled
            class="self-end"
            :label="__('modals.updateIntervention')"
        />
    </form>
</x-widgets.modals.modal-layout>
