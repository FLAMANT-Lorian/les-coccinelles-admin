<fieldset class="col-span-full">
    <legend>{{ __('pages/members.documents') }}</legend>
    <div class="grid-default">
        <x-forms.input.input-file
            class="col-span-full lg:col-span-6"
            :label="__('forms.identity-card')"
            name="id_card"
            field_name="id_card"
        />
    </div>

</fieldset>
