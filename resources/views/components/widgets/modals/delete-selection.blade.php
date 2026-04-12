<x-widgets.delete-modal-layout
    :title="__('modals.deleteSelection')"
    :message="__('modals.deleteSelectionMessage')">
    <button type="button"
            class="px-4 py-3 border border-red bg-red text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-red focus:text-red trans-all"
            @click="$dispatch('deleteSelection')">
        {{ __('modals.deleteSelection') }}
    </button>
</x-widgets.delete-modal-layout>
