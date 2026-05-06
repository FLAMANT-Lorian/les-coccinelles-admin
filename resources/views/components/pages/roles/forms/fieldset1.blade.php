<fieldset>
    <legend>{{ __('pages/roles.role-fieldset-1') }}</legend>
    <div class="grid md:grid-cols-2 gap-y-4 gap-x-8">
        <x-forms.input.input-text
            name="name"
            field_name="name"
            wire="form.name"
            :label="__('forms.role-name')"
            :placeholder="__('forms.administrator')"
            :required="true"/>

        <x-forms.input.custom-select-simple
            :collection="$this->getYesOrNo"
            :label="__('forms.role-unique')"
            :required="true"
            :enum="true"
            :translation="true"
            :term="$this->terms['unique']"
            name="unique"
            wire="terms.unique"
            select_wire="form.unique"
            field_name="unique"
        />
    </div>
</fieldset>
