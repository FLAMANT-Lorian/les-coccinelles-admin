<div class="col-span-full pt-8 border-t border-t-beige-dark/60">
    <div class="p-6 bg-red-50 border border-red rounded-sm">
        <p class="text-2xl font-medium text-red pb-2">{{ __('pages/events.delete-event') }}</p>
        <p class="text-base text-brown pb-6">{{ __('pages/events.delete-event-description') }}</p>
        <button type="button"
                @click="modalOpen = true"
                wire:click="$dispatch('open-modal', { modal: 'openDeleteModal' })"
                class="btn-delete">
            {{ __('pages/events.delete-event') }}
        </button>
    </div>
</div>
