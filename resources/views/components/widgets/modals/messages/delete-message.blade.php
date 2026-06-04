@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteMessage')"
    :message="__('modals.deleteMessageMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('deleteMessage', {id: {{ $id }}})">
        {{ __('modals.deleteMessage') }}
    </button>
</x-widgets.modals.delete-modal-layout>
