<form method="POST" novalidate
      action="{{ route('password.update', ['locale' => app()->getLocale()]) }}" {{ $attributes->merge(['class' => '']) }}>
    @csrf
    <fieldset class="flex flex-col gap-6 mb-6 border-none">
        <legend class="sr-only block!">{{ __('auth/reset-password.legend') }}</legend>

        {{-- TOKEN --}}
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

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
        <x-forms.input.input-password
            :label="__('forms.password')"
            :required="true"
            field_name="password"
            name="password"
        />

        {{-- PASSWORD --}}
        <x-forms.input.input-password
            :label="__('forms.confirm_password')"
            :required="true"
            field_name="password_confirmation"
            name="password_confirmation"
        />

    </fieldset>
    <x-forms.buttons.submit-outlined
        class="w-full"
        :label="__('auth/reset-password.submit_btn_label')"/>
</form>
