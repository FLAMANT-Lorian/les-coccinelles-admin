@props([
    'id' => '',
])

<x-widgets.delete-modal-layout
    :title="__('modals.deleteRole')"
    :message="__('modals.deleteMemberMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            @click="$dispatch('delete-role', {id: {{ $id }}})">
        {{ __('modals.deleteRole') }}
    </button>
</x-widgets.delete-modal-layout>
