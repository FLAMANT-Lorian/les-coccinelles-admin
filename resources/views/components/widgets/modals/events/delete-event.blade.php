@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteEvent')"
    :message="__('modals.deleteEventMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-event', { id: {{ $id }} })">
        {{ __('modals.deleteEvent') }}
    </button>
</x-widgets.modals.delete-modal-layout>
