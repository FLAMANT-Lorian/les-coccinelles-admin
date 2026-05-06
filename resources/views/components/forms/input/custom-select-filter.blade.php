@props([
    'collection',
    'name',
    'id',
    'wire',
    'translation' => true,
    'enum' => true,
    'accessor' => ''
])

<div {{ $attributes->merge(['class' => 'field w-full']) }} x-data="{ open: false , selected: $wire.filter ?? [] }"
     @click.away="open = false;
         $refs.input.blur();"
     @keydown.window.escape="open = false;
         $refs.input.blur();">
    <div class="w-full">
        <label for="status_filter"
               class="sr-only"
               aria-label="{{ __('tables.filter') }}">
            {{ __('tables.filter') }}
        </label>
        <div class="result-container flex rounded-sm flex-row gap-1 flex-wrap cursor-pointer trans-all"
             @click="$refs.input.focus();">
            @if(!empty($this->filter))
                @foreach($this->filter as $idx => $item)
                    <div type="button"
                         class="has-[button:hover]:bg-red has-[button:focus]:bg-red trans-all relative mr-2 z-10 text-sm px-2 py-0.5 bg-brown text-white rounded flex items-center gap-1">
                        <button @click="
                                 selected = selected.filter((item) => item !== $event.currentTarget.dataset.value);
                                 $wire.set('filter', selected);
                                 open = false;
                                 $refs.input.blur();
                                 "
                                data-value="{{ $item }}">

                            <svg width="16"
                                 height="16"
                                 viewBox="0 0 16 16"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <use href="#cross-filter"></use>
                            </svg>
                        </button>
                        <span class="whitespace-nowrap">{{ $translation ? __('enums.' . $item) : $item }}</span>
                    </div>
                @endforeach
            @endif
            <input
                @if($wire && $wire !== '')
                    wire:model.live="{{ $wire }}"
                @endif
                x-ref="input"
                @focus="open = true"
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
        class="overflow-hidden custom-select rounded-sm absolute top-[calc(100%+8px)] inset-x-0 z-10 bg-beige-light border border-brown"
        x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        x-show="open">
        <div class="flex flex-col divide-y divide-beige-medium open">
            @if(!empty($collection))
                @foreach($collection as $item)
                    <button type="button"
                            data-value="{{ $enum ? $item->value : $item[$accessor] }}"
                            class="px-4 py-3 text-left hover:bg-beige-medium focus:bg-beige-medium trans-all"
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
                        {{ ($translation ? __('enums.' . ($enum ? $item->value : $item[$accessor])) : ($enum ? $item->value : $item[$accessor])) . ' ' . (in_array(($enum ? $item->value : $item[$accessor]), $this->filter) ? '(' . __('forms.selected') . ')' : '') }}
                    </button>
                @endforeach
            @else
                <span class="mx-4 py-2 text-left">{{ __('forms.no_result') }}</span>
            @endif
        </div>
    </div>
</div>
