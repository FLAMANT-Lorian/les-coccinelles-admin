@props([
    'id',
])

<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteRole')"
    :message="__('modals.deleteMemberMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-role', {id: {{ $id }}})">
        {{ __('modals.deleteRole') }}
    </button>
</x-widgets.modals.delete-modal-layout>
