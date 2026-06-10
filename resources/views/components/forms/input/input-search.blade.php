@props([
    'wire' => '',
    'name',
    'id',
    'label',
    'placeholder',
])

<div {!! $attributes->merge(['class' => 'field self-start']) !!}
     x-data="{ focused: false, isMac: /Mac|iPhone|iPad/.test(navigator.userAgent) }">
    <label class="sr-only" for="{!! $id !!}">
        {!! $label !!}
    </label>

    <svg @click="$refs.search_input.focus()"
         width="23" height="23" viewBox="0 0 23 23" fill="none"
         xmlns="http://www.w3.org/2000/svg"
         class="absolute text-brown left-4 top-1/2 -translate-y-1/2">
        <use href="#search"/>
    </svg>
    <kbd @click="$refs.search_input.focus()"
         x-show="!focused"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="text-sm max-rg:hidden text-brown absolute right-4 top-1/2 -translate-y-1/2 flex flex-row items-center gap-1 bg-beige-medium rounded-sm px-1 py-0.5 border border-beige-dark">
        <span x-text="isMac ? '⌘' : 'Ctrl'"></span>

        <span>K</span>
    </kbd>
    <input
        x-ref="search_input"
        @keydown.window.meta.k.prevent="$el.focus()"
        @keydown.window.ctrl.k.prevent="$el.focus()"
        @keydown.escape="$el.blur()"
        @focus="focused = true"
        @blur="focused = false"
        @if($wire !== '')
            wire:model.live="{{ $wire }}"
        @endif
        class="pl-15! w-full"
        placeholder="{!! $placeholder ?? '' !!}"
        type="text"
        name="{!! $name !!}"
        id="{!! $id !!}"
        autocomplete="off">
</div>
