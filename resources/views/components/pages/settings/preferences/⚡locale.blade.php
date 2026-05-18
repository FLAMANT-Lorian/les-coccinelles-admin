<?php

use Livewire\Component;

new class extends Component {

    public string $locale;

    public function mount(): void
    {
        $this->locale = LaravelLocalization::getCurrentLocale();
    }

    public function updatedLocale(string $locale): void
    {
        LaravelLocalization::setLocale($locale);

        $this->redirect(LaravelLocalization::getLocalizedURL($locale, route('preferences')), navigate: true);
    }

};
?>


<div class="lg:col-span-5 lg:col-start-7">
    <h3 class="text-2xl font-medium mb-1">{{ __('pages/settings.preferences.locale-title') }}</h3>
    <p class="paragraph text-gray-500 mb-6">{!! __('pages/settings.preferences.locale-text') !!}</p>
    <div class="flex flex-col gap-2">

        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="radio-field">
                <input name="locale"
                       wire:model.live="locale"
                       value="{{ $localeCode }}"
                       type="radio"
                       id="{{ $localeCode . 'Locale' }}">
                <label for="{{ $localeCode . 'Locale' }}">
                    {{ $properties['native'] }}
                </label>
            </div>
        @endforeach

    </div>
</div>
