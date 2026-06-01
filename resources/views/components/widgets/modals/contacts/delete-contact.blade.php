@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteContact')"
    :message="__('modals.deleteContactMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-contact')">
        {{ __('modals.deleteContact') }}
    </button>
</x-widgets.modals.delete-modal-layout>
