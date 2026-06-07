<form method="POST" novalidate action="{{ route('login.store', ['locale' => app()->getLocale()]) }}" {{ $attributes->merge(['class' => '']) }}>
    @csrf
    <fieldset class="flex flex-col gap-6 mb-6 pt-0! border-none">
        <legend class="sr-only block!">{{ __('auth/login.legend') }}</legend>

        {{-- EMAIL --}}
        <x-forms.input.input-text
            :label="__('forms.email')"
            :required="true"
            type="email"
            field_name="email"
            name="email"
            :value="old('email')"
            placeholder="john.doe@example.com"
        />

        {{-- PASSWORD --}}
        <div class="flex flex-col gap-2">
            <x-forms.input.input-password
                :label="__('forms.password')"
                :required="true"
                field_name="password"
                name="password"
            />
            <a wire:navigate
               title="{!! __('auth/login.forgotten_password_text') !!}"
               aria-label="{!! __('auth/login.forgotten_password_text') !!}"
               href="{{ route('password.request', ['locale' => app()->getLocale()]) }}"
               class="text-base font-medium text-blue-600 underline-link after:bg-blue-600 self-end">
                {!! __('auth/login.forgotten_password_text') !!}
            </a>
        </div>
    </fieldset>
    <x-forms.buttons.submit-outlined
        class="w-full"
        :label="__('auth/login.submit_btn_label')"/>
</form>
