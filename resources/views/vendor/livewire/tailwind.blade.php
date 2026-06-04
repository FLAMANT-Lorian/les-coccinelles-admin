@php
    if (! isset($scrollTo)) {
        $scrollTo = 'table';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

<div class="self-end">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex flex-row gap-2">
                    <span class="relative z-0 inline-flex rounded-sm">
                        <span class="mr-2 ">
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('tables.previous') }}">
                                    <span
                                        class="relative inline-flex gap-2 items-center px-2 py-2 text-base font-medium text-beige-dark bg-white border border-beige-dark/60 rounded-sm cursor-not-allowed"
                                        aria-hidden="true">
                                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="#arrow-pagination"/>
                                        </svg>
                                        <span>{{ __('tables.previous') }}</span>
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                        class="relative inline-flex gap-2 items-center px-2 py-2 text-base font-medium text-brown bg-white border border-brown rounded-sm hover:bg-brown hover:text-white trans-all"
                                        aria-label="{{ __('pagination.previous') }}">
                                   <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                            <use href="#arrow-pagination"/>
                                        </svg>
                                        <span>{{ __('tables.previous') }}</span>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true" class="max-rl:hidden mx-1">
                                    <span
                                        class="relative inline-flex gap-2 items-center px-4 py-2 text-base font-medium bg-white text-brown border border-brown rounded-sm">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span class="mx-1 max-rl:hidden" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span
                                                    class="relative inline-flex gap-2 items-center px-4 py-2 text-base font-medium border border-brown rounded-sm bg-brown text-white trans-all">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button"
                                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                                    class="relative inline-flex gap-2 items-center px-4 py-2 text-base font-medium text-brown bg-white border border-brown rounded-sm hover:bg-brown hover:text-white trans-all"
                                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span class="ml-2">
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                        x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                        class="relative inline-flex gap-2 items-center px-2 py-2 text-base font-medium text-brown bg-white border border-brown rounded-sm hover:bg-brown hover:text-white trans-all"
                                        aria-label="{{ __('tables.next') }}">
                                        <span>{{ __('tables.next') }}</span>
                                    <svg class="rotate-180" width="6" height="11" viewBox="0 0 6 11" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                            <use href="#arrow-pagination"/>
                                        </svg>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('tables.next') }}">
                                    <span
                                        class="relative inline-flex gap-2 items-center px-2 py-2 text-base font-medium text-beige-dark bg-white border border-beige-dark/60 rounded-sm cursor-not-allowed"
                                        aria-hidden="true">
                                        <span>{{ __('tables.next') }}</span>
                                        <svg class="rotate-180" width="6" height="11" viewBox="0 0 6 11" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="#arrow-pagination"/>
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
            </div>
        </nav>
    @endif
</div>
