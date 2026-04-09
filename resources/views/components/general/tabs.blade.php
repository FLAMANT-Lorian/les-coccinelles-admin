@props([
    'tabs' => [],
])

@if(!empty($tabs))
    <div class="flex flex-row gap-8 border-b border-b-beige-dark/60 pb-2 mb-8 overflow-x-auto">
        @foreach ($tabs as $tab)
            <span data-tab="{{ $tab['location'] }}"
                  class="tab {{ $tab['location'] === $this->tab ? 'current-tab' : '' }}"
                  wire:click="setActiveTab('{{ $tab['location'] }}')">{{ $tab['label'] }}</span>
        @endforeach
    </div>
@endif
