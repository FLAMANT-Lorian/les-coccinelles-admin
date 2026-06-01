@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteAvailabilityRequest')"
    :message="__('modals.deleteAvailabilityRequestMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('deleteAvailabilityRequest', {id: {{ $id }}})">
        {{ __('modals.deleteAvailabilityRequest') }}
    </button>
</x-widgets.modals.delete-modal-layout>
