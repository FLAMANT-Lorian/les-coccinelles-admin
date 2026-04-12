@props([
    'tabs' => [],
])

@if(!empty($tabs))
    <div class="flex flex-row gap-8 border-b border-b-beige-dark/60 pb-2 mb-8 overflow-x-auto">
        @foreach ($tabs as $tab)
            <button type="button" data-tab="{{ $tab['location'] }}"
                    class="tab {{ $tab['location'] === $this->tab ? 'current-tab' : '' }}"
                    wire:click="setActiveTab('{{ $tab['location'] }}')">{{ $tab['label'] }}
            </button>
        @endforeach
    </div>
@endif
