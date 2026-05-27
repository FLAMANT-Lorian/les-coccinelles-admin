@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteEvent')"
    :message="__('modals.deleteEventMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            wire:click="$dispatch('delete-event', { id: {{ $id }} })">
        {{ __('modals.deleteEvent') }}
    </button>
</x-widgets.modals.delete-modal-layout>
