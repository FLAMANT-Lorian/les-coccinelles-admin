@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteIntervention')"
    :message="__('modals.deleteInterventionMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            wire:click="$dispatch('delete-intervention')">
        {{ __('modals.deleteIntervention') }}
    </button>
</x-widgets.modals.delete-modal-layout>
