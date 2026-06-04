<fieldset class="gap-1! border-none">
    <legend class="sr-only">{{ __('pages/members.password') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8">
        <x-forms.input.input-password
            class="col-span-1"
            name="old_password"
            field_name="old_password"
            :label="__('forms.old_password')"
            :required="true"
            wire="form.old_password"
        />

        <x-forms.input.input-password
            class="col-span-1"
            name="new_password"
            field_name="new_password"
            :label="__('forms.new_password')"
            :required="true"
            wire="form.new_password"
        />
    </div>
</fieldset>
