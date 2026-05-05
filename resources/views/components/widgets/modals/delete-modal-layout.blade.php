@props([
    'title',
    'message'
])

<div class="showModal fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden bg-brown/50 px-6 "
     x-show="modalOpen"
     x-trap="modalOpen"
     @keydown.window.escape="$dispatch('close-modal'); modalOpen = false">
    <div class="flex flex-col gap-6 w-full max-w-150 bg-red-50 border border-red rounded-sm p-6">
        <div class="flex flex-row gap-12 items-start justify-between">
            <div class="flex flex-col gap-1">
                <p class="text-2xl text-red font-medium">{{ $title }}</p>
                <p class="text-base">{{ $message }}</p>
            </div>
            <button title="{{ __('modals.close') }}"
                    type="button"
                    class="w-8 h-8 cursor-pointer"
                    wire:click="$dispatch('close-modal'); modalOpen = false">
                <svg class="hover:bg-red rounded-sm text-brown hover:text-white trans-all" width="32" height="32"
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
