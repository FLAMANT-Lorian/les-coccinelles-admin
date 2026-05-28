@php
    use App\Models\Folder;
       /**
        * @var Folder $folder
        */
       $disk = config('filesystems.default');
       $original_path = config('events.original_path') . '/' . $folder->path;
@endphp

@props([
    'folder'
])
<x-widgets.modals.modal-layout
    :title="$folder->name">
    <div class="flex flex-col">
        <div
            class="px-3 text-brown font-medium pb-2 flex flex-row items-center justify-between border-b border-b-beige-dark">
            <span>{{ __('pages/events.folders.name') }}</span>
            <span>{{ __('pages/events.folders.actions') }}</span>
        </div>
        @if($folder->files->isNotEmpty())
            <div class="max-h-100 overflow-y-auto divide-y divide-beige-dark/60">
                @foreach($folder->files as $file)
                    @php
                        $path = $original_path . '/' . $file->path;
                    @endphp
                    @if(Storage::disk($disk)->exists($path))
                        <div class="text-brown flex flex-row justify-between gap-8 p-3 hover:bg-beige-light trans-all">
                            <div class="flex flex-row items-center gap-4 min-w-0">
                                <svg class="min-w-6 w-6 h-6 min-h-6" ...>
                                    <use href="#file"></use>
                                </svg>
                                <a href="{{ Storage::disk($disk)->url($path) }}"
                                   class="overflow-x-auto whitespace-nowrap font-medium hover:pl-2 trans-all"
                                   data-fancybox="folder-{{ $folder->id }}">
                                    {{ $file->name }}
                                </a>
                            </div>
                            <div class="flex flex-row  items-center gap-4">
                                <a href="{{ Storage::disk($disk)->url($path) }}"
                                   download="{{$file->name}}"
                                   class="hover:bg-beige-medium rounded-sm p-1 trans-all"
                                   aria-label="{{ __('pages/events.folders.download') }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="#download"></use>
                                    </svg>
                                    <span class="sr-only">{{ __('pages/events.folders.download') }}</span>
                                </a>
                                <button type="button"
                                        class="hover:bg-beige-medium rounded-sm p-1 trans-all"
                                        wire:click="$dispatch('delete-file', { id: {{ $file->id }} })">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="#bin"></use>
                                    </svg>
                                    <span class="sr-only">{{ __('pages/events.folders.delete_file') }}</span>
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <span class="p-6 text-red text-center">{{ __('pages/events.folders.no_files') }}</span>
        @endif
    </div>
    <div class="flex justify-center mt-6">
        <input class="sr-only"
               type="file"
               id="fileSelector"
               wire:model.live="files"
               multiple>
        <label for="fileSelector"
               class="cursor-pointer btn-small bg-brown border border-brown text-white hover:bg-transparent hover:text-brown trans-all">
            {{ __('pages/events.folders.add_files') }}
        </label>
    </div>
</x-widgets.modals.modal-layout>
