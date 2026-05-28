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
        @if($url = $this->event->google_drive_url)
            <a href="{{ $url }}"
               target="_blank"
               aria-label="{{ __('pages/events.folders.google_drive_link') }}"
               class="btn-small bg-brown border border-brown text-white hover:text-brown hover:bg-transparent">
                {{ __('pages/events.folders.google_drive_link') }}
            </a>
        @endif
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 rl:grid-cols-3 gap-6 mt-6">
        @if($this->event->folders->isNotEmpty())
            @foreach($this->event->folders as $folder)
                <x-pages.events.show.folders.folder
                    :folder="$folder"/>
            @endforeach
        @endif
        <x-pages.events.show.folders.add-folder/>
    </div>
</div>
