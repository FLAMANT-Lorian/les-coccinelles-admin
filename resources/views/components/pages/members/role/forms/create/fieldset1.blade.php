<fieldset>
    <legend>{{ __('pages/members.role-fieldset-1') }}</legend>
    <div class="grid grid-cols-2 gap-y-4 gap-x-8">
        <x-forms.input.input-text
            name="name"
            field_name="name"
            :label="__('forms.role-name')"
            :placeholder="__('forms.administrator')"
            :required="true"/>

        <x-forms.input.custom-select
            :collection="$this->getYesOrNo"
            :label="__('forms.role-unique')"
            :multiple="false"
            key="unique"
            :term="$this->terms['unique']"
            name="unique"
            wire="terms.unique"
            field_name="unique"
        />
    </div>
</fieldset>
