<form method="POST" action="{{ route('login.store') }}" {{ $attributes->merge(['class' => '']) }}>
    @csrf
    <fieldset class="flex flex-col gap-6 mb-6">
        <legend class="sr-only">Identifiants de connexion</legend>

        {{-- EMAIL --}}
        <x-forms.input.input-text
                :label="__('forms.email_label')"
                :required="true"
                type="email"
                field_name="email"
                name="email"
                placeholder="john.doe@example.com"
        />

        {{-- PASSWORD --}}
        <div class="flex flex-col gap-2">
            <x-forms.input.input-password
                    :label="__('forms.password_label')"
                    :required="true"
                    field_name="password"
                    name="password"
            />
            <a href="{{ route('password.request') }}"
               class="text-base font-medium text-blue-600 hover:underline self-end">
                {!! __('forms.forgotten_password_text') !!}
            </a>
        </div>

    </fieldset>
    <x-forms.buttons.submit
            class="w-full"
            :label="__('auth/login.submit_btn_label')"/>
</form>
