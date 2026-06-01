@props([
    'id',
])
<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteMember')"
    :message="__('modals.deleteMemberMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-member', {id: {{ $id ?? false }}})">
        {{ __('modals.deleteMember') }}
    </button>
</x-widgets.modals.delete-modal-layout>
