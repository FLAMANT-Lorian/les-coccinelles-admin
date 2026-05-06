@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteUtilityCost')"
    :message="__('modals.deleteUtilityCostMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            wire:click="deleteUtilityCost({{ $id ?? false }})">
        {{ __('modals.deleteUtilityCost') }}
    </button>
</x-widgets.modals.delete-modal-layout>
