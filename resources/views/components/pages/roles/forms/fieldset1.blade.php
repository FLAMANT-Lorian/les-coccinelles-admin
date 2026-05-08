@php
    use App\Enums\YesOrNo;
@endphp

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

        <x-forms.input.custom-select-simple-enum
            :collection="$this->getYesOrNo"
            :label="__('forms.role-unique')"
            name="unique"
            search_wire="terms.unique"
            select_wire="form.unique"
            :form_property="$this->form->unique"
            state="uniqueSelectState"
            field_name="unique"
            :enum="YesOrNo::class"
        />
    </div>
</fieldset>
