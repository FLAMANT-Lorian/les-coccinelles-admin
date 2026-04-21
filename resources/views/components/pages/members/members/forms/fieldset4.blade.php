<fieldset class="gap-1! border-none">
    <legend>{{ __('pages/members.password') }}</legend>
    <span class="text-gray mb-4">{{ __('pages/members.password-description') }}</span>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8">
        <x-forms.input.input-password
            class="col-span-1"
            name="password"
            field_name="password"
            :label="__('forms.password')"
            :required="true"
            wire="form.password"
        />
    </div>
</fieldset>
