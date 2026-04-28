<x-widgets.delete-modal-layout
    :title="__('modals.deleteMember')"
    :message="__('modals.deleteMemberMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            @click="$dispatch('delete-member', {id: {{ $id ?? false }}})">
        {{ __('modals.deleteMember') }}
    </button>
</x-widgets.delete-modal-layout>
