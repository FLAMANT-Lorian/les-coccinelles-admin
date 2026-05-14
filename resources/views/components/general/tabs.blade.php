@props([
    'tabs' => [],
])

@if(!empty($tabs))
    <div class="flex flex-row gap-8 border-b border-b-beige-dark/60 pb-2 mb-8 overflow-x-auto">
        @foreach ($tabs as $tab)
            @can('view-any', $tab['model'])
                <a href="{{ $tab['location'] }}"
                   wire:current.exact="current-tab"
                   class="tab"
                   wire:navigate>
                    {{ $tab['label'] }}
                </a>
            @endcan
        @endforeach
    </div>
@endif
