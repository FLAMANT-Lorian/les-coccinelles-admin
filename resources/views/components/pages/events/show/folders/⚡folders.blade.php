<?php

use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Event;

new class extends Component {
    public Event $event;

    public function mount(Event $event): void
    {
        $this->event = $event;
    }
};
?>

<div class="col-span-full xg:col-span-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between items-start gap-6">
        <div>
            <h2 class="text-2xl font-medium text-brown">{{ __('pages/events.folders.title') }}</h2>
            <p class="text-gray-500 paragraph">{{ __('pages/events.folders.subtitle') }}</p>
        </div>
        <a href="#"
           aria-label="{{ __('pages/events.folders.google_drive_link') }}"
           class="btn-small bg-brown border border-brown text-white hover:text-brown hover:bg-transparent">
            {{ __('pages/events.folders.google_drive_link') }}
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 rl:grid-cols-3 gap-6 mt-6">
        @if($this->event->folders->isNotEmpty())
            @foreach($this->event->folders as $folder)
                <button type="button"
                        wire:click="$dispatch('open-modal', { modal: 'openFolderModal', folder_id: {{ $folder->id }} })"
                        class="flex flex-col items-center p-6 w-full rounded-sm border border-beige-dark bg-beige-light hover:bg-beige-medium trans-all">
                    <svg style="color: {{ $folder->color }}" width="40" height="40" viewBox="0 0 40 40" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <use href="#folder"></use>
                    </svg>
                    <span class="mt-3 mb-1 text-2xl text-brown font-medium">{{ $folder->name }}</span>
                    <span class="text-sm text-gray-500">{{ __('pages/events.folders.file_count') }}</span>
                </button>
            @endforeach
        @endif
        <button type="button"
                wire:click="$dispatch('open-modal', { modal: 'openCreateFolderModal' })"
                class="flex flex-col gap-2 items-center justify-center p-6 w-full rounded-sm border border-beige-dark bg-beige-light hover:bg-beige-medium trans-all">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#add-folder"></use>
            </svg>
            <span class="text-base text-brown">{{ __('pages/events.folders.add_folder') }}</span>
        </button>
    </div>
</div>
