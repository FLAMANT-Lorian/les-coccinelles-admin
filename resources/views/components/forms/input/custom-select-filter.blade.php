@props([
    'collection',
    'name',
    'id',
    'wire',
])

<div {{ $attributes->merge(['class' => 'field min-w-50']) }} x-data="{ open: false , selected: $wire.filter ?? [] }"
     @click.away="open = false;
         $refs.input.blur();"
     x-on:keydown.window.escape="open = false;
         $refs.input.blur();">
    <div class="w-full">
        <label for="status_filter"
               class="sr-only"
               aria-label="{{ __('tables.filterStatus') }}">
            {{ __('tables.filterStatus') }}
        </label>
        <div class="result-container flex rounded-sm flex-row cursor-pointer trans-all"
             @click="$refs.input.focus();"
             :class="open ? 'rounded-b-none!' : ''">
            @if(!empty($this->filter))
                @foreach($this->filter as $idx => $item)
                    <button data-value="{{ $item }}"
                            type="button"
                            @click="
                                 selected = selected.filter((item) => item !== $event.currentTarget.dataset.value);
                                 $wire.set('filter', selected);
                                 open = false;
                                 $refs.input.blur();
                            "
                            class="relative mr-2 z-10 text-sm px-2 py-0.5 bg-brown text-white rounded flex items-center gap-1">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <use href="#cross-filter"></use>
                        </svg>
                        <span class="whitespace-nowrap">{{ __('enums.' . $item) }}</span>
                    </button>
                @endforeach
            @endif
            <input
                @if($wire && $wire !== '')
                    wire:model.live="{{ $wire }}"
                @endif
                x-ref="input"
                @focus="open = true"
                :class="open ? 'rounded-b-none!' : ''"
                placeholder="Filtrer"
                class="w-20" type="text" name="status_filter_term" id="status_filter">
            <svg :class="open ? 'rotate-90' : '-rotate-90'"
                 class="pointer-events-none cursor-pointer trans-all absolute right-4 top-1/2 -translate-y-1/2"
                 width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#arrow-pagination"></use>
            </svg>
        </div>
    </div>
    <div
        class="custom-select rounded-b-sm absolute top-full -mt-px inset-x-0 z-10 bg-beige-light border border-brown border-t-0 roundned-sm"
        x-show="open">
        <div class="flex flex-col divide-y divide-beige-medium open">
            @if(!empty($collection))
                @foreach($collection as $item)
                    <button type="button"
                            data-value="{{ $item->value }}"
                            class="mx-4 py-2 text-left text-sm"
                            @click="open = false;
                        $refs.input.blur();

                        let value = $event.currentTarget.dataset.value;

                        if (selected.includes(value)) {
                            selected = selected.filter((item) => item !== value);
                        } else {
                            selected.push(value);
                        }

                        $wire.set('filter', selected);
                        $wire.set('filter_term', '');">
                        {{ __('enums.' . $item->value) . ' ' . (in_array($item->value, $this->filter) ? '(' . __('forms.selected') . ')' : '') }}
                    </button>
                @endforeach
            @else
                <span class="mx-4 py-2 text-left text-sm">{{ __('forms.no_result') }}</span>
            @endif
        </div>
    </div>
</div>
