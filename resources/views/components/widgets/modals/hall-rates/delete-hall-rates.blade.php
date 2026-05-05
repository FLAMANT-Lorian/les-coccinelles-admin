@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteHallRate')"
    :message="__('modals.deleteMemberMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            wire:click="$dispatch('delete-hall-rate', {id: {{ $id ?? false }}})">
        {{ __('modals.deleteHallRate') }}
    </button>
</x-widgets.modals.delete-modal-layout>
