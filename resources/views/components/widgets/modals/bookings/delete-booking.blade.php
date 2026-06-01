@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteBooking')"
    :message="__('modals.deleteBookingMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-booking', { id: {{ $id }} })">
        {{ __('modals.deleteBooking') }}
    </button>
</x-widgets.modals.delete-modal-layout>
