<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.textarea
        wire="form.address"
        class="col-span-full"
        textarea_class="min-h-40!"
        name="address"
        field_name="address"
        :label="__('forms.address')"
        :placeholder="__('forms.address_placeholder')"
    />

    <x-forms.input.input-date
        :label="__('forms.date')"
        :placeholder="__('forms.booking-date-placeholder')"
        name="date"
        :required="true"
        field_name="date"
        wire="form.date"/>

    <x-forms.input.input-text
        :label="__('forms.hour')"
        name="hour"
        :required="true"
        type="time"
        field_name="hour"
        wire="form.hour"
    />

    <x-forms.input.textarea
        wire="form.description"
        class="col-span-full"
        textarea_class="min-h-40!"
        name="description"
        field_name="description"
        :label="__('forms.meeting_description')"
        :placeholder="__('forms.more_information')"
    />

    <div class="col-span-full flex flex-row flex-wrap gap-6 items-center">
        @if($this->form->file)
            <div class="flex flex-row gap-4 items-center px-4 py-2 rounded-sm bg-beige-light">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#file"></use>
                </svg>
                <span>{{ $this->form->file->getClientOriginalName() }}</span>
                <button type="button" wire:click="$dispatch('remove-file')">
                    <svg class=" hover:bg-brown rounded-sm text-brown hover:text-white trans-all"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.7071 11.9892L18.0159 17.298L17.3088 18.0051L12 12.6963L6.69117 18.0051L5.98407 17.298L11.2929 11.9892L5.99512 6.69141L6.70222 5.9843L12 11.2821L17.2978 5.9843L18.0049 6.69141L12.7071 11.9892Z"
                            fill="currentColor"/>
                    </svg>

                    <span class="text-brown text-base sr-only">{{ __('forms.remove-meeting-file') }}</span>
                </button>
            </div>
        @elseif($this->meeting && $this->meeting->file && Storage::disk(config('filesystems.default'))->exists(config('meetings.original_path') . '/' . $this->meeting->file))
            <div class="flex flex-row gap-4 items-center px-4 py-2 rounded-sm bg-beige-light">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#file"></use>
                </svg>
                <a href="{{ Storage::disk(config('filesystems.default'))->url(config('meetings.original_path') . '/' . $this->meeting->file) }}"
                   title="{{ __('general.view-file') }}"
                   aria-label="{{ $this->meeting->file }}"
                   class="underline-link after:bg-brown"
                   data-fancybox>
                    {{ $this->meeting->file }}
                </a>
                <button type="button"
                        wire:click="$dispatch('delete-file')">
                    <svg class=" hover:bg-brown rounded-sm text-brown hover:text-white trans-all"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.7071 11.9892L18.0159 17.298L17.3088 18.0051L12 12.6963L6.69117 18.0051L5.98407 17.298L11.2929 11.9892L5.99512 6.69141L6.70222 5.9843L12 11.2821L17.2978 5.9843L18.0049 6.69141L12.7071 11.9892Z"
                            fill="currentColor"/>
                    </svg>

                    <span class="text-brown text-base sr-only">{{ __('forms.remove-meeting-file') }}</span>
                </button>
            </div>
        @endif
        <input class="sr-only"
               id="meeting_file"
               accept="application/pdf"
               wire:model="form.file"
               type="file">
        <label for="meeting_file"
               class="cursor-pointer text-blue-600 underline-link after:bg-blue-600">
            @if($this->form->file || ($this->meeting && $this->meeting->file))
                {{ __('forms.change-meeting-file') }}
            @else
                {{ __('forms.add-meeting-file') }}
            @endif
        </label>
    </div>

</fieldset>
