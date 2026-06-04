@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteTask')"
    :message="__('modals.deleteTaskMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-task', { id: {{ $id }} })">
        {{ __('modals.deleteTask') }}
    </button>
</x-widgets.modals.delete-modal-layout>
