@props([
    'term' => false,
])

<div class="flex flex-col items-center gap-4 m-auto mt-10 w-max py-6 px-10 border border-brown rounded-sm">
            <span class="p-4 bg-gray-100 rounded-full">
            <svg class="text-brown" xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/>
                <path d="m9.5 10.5 5 5"/>
                <path d="m14.5 10.5-5 5"/>
            </svg>
            </span>
    <p class="paragraph">
        @if($this->term)
            <span>{{ __('tables.no-results-for') }}</span>
            <strong class="font-semibold text-red">
                {{ $this->term }}
            </strong>
        @else
            <span>{{ __('tables.no-results') }}</span>
        @endif
    </p>
</div>
