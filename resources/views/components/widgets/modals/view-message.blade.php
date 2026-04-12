@props([
    'message'
])

<x-widgets.modal-layout
    :title="__('modals.viewMessage') . $message->fullName"
    :message="false">
    <div class="text-brown flex flex-col">
        <div class="flex flex-col gap-1 pb-4 border-b border-b-beige-dark/60">
            <p>
                <span class="font-semibold">{{ __('modals.object') }}</span>
                <span>{{ $message->subject }}</span>
            <p>
            <p>
                <span class="font-semibold">{{ __('modals.from') }} </span>
                <a class="underline-link after:bg-brown"
                   href="mailto:{{ $message->email }}"
                   aria-label="{{ $message->email }}"
                   title="{{ __('tables.send-email-to') . $message->email }}">
                    {{ $message->email }}
                </a>
            </p>
        </div>
        <p class="mt-4">
            {{ $message->message }}
        </p>
        <div class="mt-8 self-end">
            <a class="flex flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent focus:bg-transparent hover:text-brown focus:text-brown trans-all"
               href="mailto:{{ $message->email }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 18v-2a4 4 0 0 0-4-4H4"/>
                    <path d="m9 17-5-5 5-5"/>
                </svg>
                <span>{{ __('modals.reply') }}</span>
            </a>
        </div>
    </div>
</x-widgets.modal-layout>
