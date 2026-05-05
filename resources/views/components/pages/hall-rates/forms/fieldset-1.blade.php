<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        class="col-span-full"
        :label="__('forms.type')"
        name="type"
        :required="true"
        :placeholder="__('forms.type_placeholder')"
        field_name="type"
        wire="form.type"
    />
    <x-forms.input.input-price
        :label="__('forms.base_price')"
        name="base_price"
        :required="true"
        placeholder="Ex : 120,5"
        field_name="base_price"
        wire="form.base_price"
    />
    <x-forms.input.input-price
        :label="__('forms.member_price')"
        name="member_price"
        :required="true"
        placeholder="Ex : 120,5"
        field_name="member_price"
        wire="form.member_price"
    />
</fieldset>
