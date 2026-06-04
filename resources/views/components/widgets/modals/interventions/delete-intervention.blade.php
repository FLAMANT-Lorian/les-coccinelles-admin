<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteIntervention')"
    :message="__('modals.deleteInterventionMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-intervention')">
        {{ __('modals.deleteIntervention') }}
    </button>
</x-widgets.modals.delete-modal-layout>
