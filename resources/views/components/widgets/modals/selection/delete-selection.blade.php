@props([
    'action'
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteSelection')"
    :message="__('modals.deleteSelectionMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('{{ $action }}')">
        {{ __('modals.deleteSelection') }}
    </button>
</x-widgets.modals.delete-modal-layout>
