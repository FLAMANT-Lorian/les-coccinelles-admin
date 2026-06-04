@php
    use App\Models\Folder;
        /**
         * @var Folder $folder;
         */
@endphp

@props([
    'folder'
])

<div type="button"
     x-data="{ open: false }"
     :class="open ? 'lg:bg-beige-medium' : ''"
     class="relative min-h-39.5 flex flex-col items-center p-6 w-full rounded-sm border border-beige-dark bg-beige-light hover:bg-beige-medium trans-all">
    <svg style="color: {{ $folder->color }}" width="40" height="40" viewBox="0 0 40 40" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <use href="#folder"></use>
    </svg>
    @can('view', Folder::class)
        <button type="button"
                wire:click="$dispatch('open-modal', { modal: 'openFolderModal', folder_id: {{ $folder->id }} })"
                class="mt-3 mb-1 text-2xl text-brown font-medium underline-link after:bg-brown">
            {{ $folder->name }}
        </button>
    @else
        <span class="mt-3 mb-1 text-2xl text-brown font-medium text-center">{{ $folder->name }}</span>
    @endcan
    <span class="text-sm text-gray-500">{{ $folder->files->count() .  __('pages/events.folders.file_count') }}</span>

    {{-- ACTIONS --}}
    @canany(['update', 'delete'], Folder::class)
        <button type="button"
                @click="open = !open"
                @click.away="open = false"
                @keydown.window.escape="open = false"
                :class="open ? 'lg:bg-beige-light' : ''"
                class="absolute top-4 right-1 rotate-90 p-2 hover:bg-beige-light trans-all rounded-sm">
            <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#table-actions"></use>
            </svg>
            <span class="sr-only">{{ __('tables.fast-actions') }}</span>
        </button>
        <div x-show="open" x-transition class="actions-table top-12!">
            @can('update', Folder::class)
                <button type="button"
                        wire:click="$dispatch('open-modal', {modal: 'openUpdateFolderModal', folder_id: {{ $folder->id }}})"
                        title="{{ __('pages/events.folders.add_folder') }}">
                    <span>{{ __('tables.update') }}</span>
                </button>
            @endcan
            @can('delete', Folder::class)
                <button type="button"
                        wire:click="$dispatch('open-modal', {modal: 'openDeleteFolderModal', folder_id: {{ $folder->id }}})"
                        title="{{ __('pages/events.folders.delete_folder') }}">
                    <span>{{ __('tables.delete') }}</span>
                </button>
            @endcan
        </div>
    @endcan
</div>
