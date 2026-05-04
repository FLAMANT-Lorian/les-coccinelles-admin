@php
    $disk = config('filesystems.default');
@endphp
<fieldset {{ $attributes->merge(['class' => 'col-span-full']) }}>
    <legend>{{ __('pages/members.documents') }}</legend>
    <div class="grid-default relative">

        <input id="id_card"
               wire:model="form.documents"
               multiple
               type="file"
               class="sr-only"
               x-ref="input"
               accept="image/png, image/jpg, image/webp">

        <span class="text-brown text-base font-medium pl-3 cursor-default col-span-full justify-self-start mb-1"
              @click="$refs.input.click()">
                    {{ __('forms.identity-documents') }}
                </span>
        <div class="col-span-full grid grid-cols-1 lg:grid-cols-4 gap-8">
            <label for="id_card"
                   class="text-center paragraph h-60 flex flex-col gap-4 justify-center items-center w-full border rounded-sm border-dashed border-beige-dark hover:bg-beige-light p-4 trans-all cursor-pointer"
                   aria-label="{!! __('forms.choose-files') !!}">
                    <span class="p-3 rounded-full bg-beige-medium">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#add-files"/>
                        </svg>
                    </span>
                <span>{!! __('forms.choose-files') !!}</span>
                <span class="text-sm text-gray-500">{!! __('forms.available-file-types') !!}</span>
            </label>
            <div class="grid grid-rows-2 grid-flow-col auto-cols-[108px] gap-6 overflow-x-auto lg:col-span-3">
                @if($this->form->member && $this->form->member->documents && !empty($this->form->member->documents))
                    @foreach($this->form->member->documents as $document)
                        @php
                            $originalPath = config('documents.original_path') . '/' . $document;
                            $variantPath = sprintf(config('documents.variant_path'), config('documents.sizes.256.width'), config('documents.sizes.256.height')) . '/' . $document;
                        @endphp

                        @if(Storage::disk($disk)->exists($variantPath))
                            <div class="w-27 h-27 relative border border-beige-dark rounded-sm overflow-hidden">
                                <img
                                    src="{{ Storage::disk($disk)->url($variantPath) }}"
                                    class="w-full h-full object-cover aspect-square"
                                    alt="Image">
                                <button type="button"
                                        wire:click="removeOldDocument('{{ $document }}', {{ $this->form->member->id }})"
                                        class="absolute z-2 top-2 right-2 cursor-pointer bg-red rounded-sm p-1 hover:rounded-lg trans-all">
                                    <span class="sr-only">{{ __('general.remove-image') }}</span>
                                    <svg class="text-white" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.7071 11.9889L18.0159 17.2978L17.3088 18.0049L12 12.696L6.69117 18.0049L5.98407 17.2978L11.2929 11.9889L5.99512 6.69116L6.70222 5.98406L12 11.2818L17.2978 5.98406L18.0049 6.69116L12.7071 11.9889Z"
                                            fill="currentColor"/>
                                    </svg>
                                </button>
                                <a class="group hover:bg-black/60 trans-all absolute inset-0"
                                   title="{{ __('general.download-image') }}"
                                   aria-label="{{ __('general.download-image') }}"
                                   href="{{ Storage::disk($disk)->url($originalPath) }}"
                                   download>
                                    <span class="sr-only">{{ __('general.download-image') }}</span>
                                    <svg class="opacity-0 group-hover:opacity-100 group-hover:text-white trans-all absolute right-2 bottom-2"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M12 15V3"/>
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <path d="m7 10 5 5 5-5"/>
                                    </svg>
                                </a>
                            </div>
                        @elseif(Storage::disk($disk)->exists($originalPath))
                            <div class="h-27 w-27 relative border border-beige-dark rounded-sm overflow-hidden">
                                <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animate-spin"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1"
                                     stroke-linecap="round">
                                    <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                                </svg>
                            </div>
                        @endif
                    @endforeach
                @endif
                @if($this->form->documents)
                    @foreach($this->form->documents as $id => $id_card)
                        <div class="w-27 h-27 relative border border-beige-dark rounded-sm overflow-hidden">
                            <img src="{{ $id_card->temporaryUrl() }}"
                                 class="w-full h-full object-cover aspect-square"
                                 alt="Image">
                            <button type="button"
                                    wire:click="$dispatch('remove-card', {id: {{ $id }}})"
                                    class="absolute top-2 right-2 cursor-pointer bg-red rounded-sm p-1 hover:rounded-lg trans-all">
                                <span class="sr-only">{{ __('general.remove-image') }}</span>
                                <svg class="text-white" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.7071 11.9889L18.0159 17.2978L17.3088 18.0049L12 12.696L6.69117 18.0049L5.98407 17.2978L11.2929 11.9889L5.99512 6.69116L6.70222 5.98406L12 11.2818L17.2978 5.98406L18.0049 6.69116L12.7071 11.9889Z"
                                        fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @error('form.documents')
        <p class="absolute whitespace-nowrap -bottom-6 text-red text-sm font-medium">{!! $message !!}</p>
        @enderror
    </div>
</fieldset>
