@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteHallRate')"
    :message="__('modals.deleteMemberMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-hall-rate', {id: {{ $id ?? false }}})">
        {{ __('modals.deleteHallRate') }}
    </button>
</x-widgets.modals.delete-modal-layout>
