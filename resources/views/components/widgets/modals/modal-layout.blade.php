@props([
    'title',
    'message' => null,
    'overflow' => true
])

<div class="showModal fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden bg-brown/60 px-6"
     x-init="modalOpen = true"
     x-trap="modalOpen"
     @keydown.window.escape="$dispatch('close-modal'); modalOpen = false">
    <div
        class="flex flex-col gap-4 w-full max-w-200 bg-beige-medium rounded-sm p-6 m-6 @if($overflow) overflow-y-auto @endif">
        <div class="flex flex-row gap-4 justify-between">
            <div class="flex flex-col gap-1">
                <p class="text-2xl text-brown font-medium">{{ $title }}</p>
                @if($message)
                    <p class="text-base">{!! $message !!}</p>
                @endif
            </div>
            <button type="button"
                    title="{{ __('modals.close') }}"
                    class="w-8 h-8 cursor-pointer"
                    wire:click="$dispatch('close-modal'); modalOpen = false">
                <svg class=" hover:bg-brown rounded-sm text-brown hover:text-white trans-all" width="32" height="32"
                     viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.7071 15.9889L22.0159 21.2978L21.3088 22.0049L16 16.696L10.6912 22.0049L9.98407 21.2978L15.2929 15.9889L9.99512 10.6912L10.7022 9.98406L16 15.2818L21.2978 9.98406L22.0049 10.6912L16.7071 15.9889Z"
                        fill="currentColor"/>
                </svg>
            </button>
        </div>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
