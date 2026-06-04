@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteFolder')"
    :message="__('modals.deleteFolderMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-folder', { id: {{ $id }} })">
        {{ __('modals.deleteFolder') }}
    </button>
</x-widgets.modals.delete-modal-layout>
