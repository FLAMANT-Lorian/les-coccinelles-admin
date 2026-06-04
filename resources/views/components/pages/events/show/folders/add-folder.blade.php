<button type="button"
        wire:click="$dispatch('open-modal', { modal: 'openCreateFolderModal' })"
        class="min-h-39.5 flex flex-col gap-2 items-center justify-center p-6 w-full rounded-sm border border-beige-dark bg-beige-light hover:bg-beige-medium trans-all">
    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <use href="#add-folder"></use>
    </svg>
    <span class="text-base text-brown">{{ __('pages/events.folders.add_folder') }}</span>
</button>
