<x-widgets.modals.delete-modal-layout
    :title="__('modals.deleteMeeting')"
    :message="__('modals.deleteMeetingMessage')">
    <button type="button"
            class="btn-delete"
            wire:click="$dispatch('delete-meeting')">
        {{ __('modals.deleteMeeting') }}
    </button>
</x-widgets.modals.delete-modal-layout>
