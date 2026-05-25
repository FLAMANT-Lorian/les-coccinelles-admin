<form method="POST" action="{{ route('password.email', app()->getLocale()) }}" {{ $attributes->merge(['class' => '']) }}>
    @csrf
    <fieldset class="flex flex-col gap-6 mb-6 border-none">
        <legend class="sr-only block!">{{ __('auth/forgot-password.legend') }}</legend>

        {{-- EMAIL --}}
        <x-forms.input.input-text
                :label="__('forms.email')"
                :required="true"
                type="email"
                field_name="email"
                name="email"
                placeholder="john.doe@example.com"
        />

    </fieldset>
    <x-forms.buttons.submit-outlined
            class="w-full"
            :label="__('auth/forgot-password.submit_btn_label')"/>
</form>
