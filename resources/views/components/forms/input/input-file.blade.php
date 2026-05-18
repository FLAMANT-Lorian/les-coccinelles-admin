@props([
    'field_name' => '',
    'label' => '',
    'required' => null,
    'multiple' => null,
    'wire' => '',
    'form_property' => null,
])

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 gap-x-8']) }}>

    <input id="{{ $field_name }}"
           @if($wire && $wire !== '')
               wire:model="{{ $wire }}"
           @endif
           @if($multiple)
               multiple
           @endif
           @if($required)
               required
           @endif
           type="file"
           class="sr-only"
           x-ref="input"
           accept="image/jpeg, image/png, image/jpg, image/webp">

    <div class="flex flex-col items-start gap-1">
        <span class="text-brown text-base font-medium pl-3 cursor-default"
              @click="$refs.input.click()">
            {{ $label }}
            @if($required)
                <strong class="text-red">*</strong>
            @endif
        </span>
        <label for="{{ $field_name }}"
               class="paragraph h-40 flex gap-4 justify-center items-center w-full border rounded-sm border-dashed border-beige-dark hover:bg-beige-light p-2 trans-all cursor-pointer"
               aria-label="{!! __('forms.choose-files') !!}">
            {!! __('forms.choose-files') !!}
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#add-files"/>
            </svg>
        </label>
    </div>
    @if($form_property)
        <div class="file-container">

        </div>
    @endif
</div>
