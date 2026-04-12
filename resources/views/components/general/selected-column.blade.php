@php
    use App\Enums\MessageStatus;
@endphp

@props([
    'selectedColumn',
    'options'
])

<div
    class="{{ $this->selectedColumn ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none' }} trans-all absolute top-6 px-4 py-2 rounded-sm flex items-center gap-3 bg-beige-medium w-fit">
            <span
                class="pr-3 border-r border-r-brown">{{ count($this->selectedColumn) . ' ' . __('tables.multiple-selected') }}</span>
    @if($options['delete'] ?? false)
        <button title="{{ __('tables.multiple-delete') }}"
                type="button"
                class="p-1 hover:bg-beige-light trans-all rounded-sm"
                wire:click="$dispatch('openModal', { modal: 'deleteAll' })">
            <svg class="text-brown" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <use href="#bin"/>
            </svg>
            <span class="sr-only">{{ __('tables.multiple-delete') }}</span>
        </button>
    @endif
    @if($options['markAsRead'] ?? false)
        <button title="{{ __('tables.mark-as-read') }}"
                type="button"
                class="p-1 hover:bg-beige-light trans-all rounded-sm"
                wire:click="$dispatch('markMessageSelectionAs', { value: '{{ MessageStatus::Read->value }}' })">
            <svg class="text-brown" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                 fill="none">
                <use href="#markAsRead"/>
            </svg>
            <span class="sr-only">{{ __('tables.mark-as-read') }}</span>
        </button>
    @endif

    @if($options['markAsNotRead'] ?? false)
        <button title="{{ __('tables.mark-as-not-read') }}"
                type="button"
                class="p-1 hover:bg-beige-light trans-all rounded-sm"
                wire:click="$dispatch('markMessageSelectionAs', { value: '{{ MessageStatus::Unread->value }}' })">
            <svg class="text-brown" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                 fill="none">
                <use href="#markAsNotRead"/>
            </svg>
            <span class="sr-only">{{ __('tables.mark-as-not-read') }}</span>
        </button>
    @endif
</div>
