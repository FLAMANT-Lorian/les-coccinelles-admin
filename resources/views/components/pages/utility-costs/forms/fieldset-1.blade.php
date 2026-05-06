<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        :label="__('forms.type')"
        name="type"
        :required="true"
        :placeholder="__('forms.type_placeholder')"
        field_name="type"
        wire="form.type"
    />

    <x-forms.input.custom-select-simple
        :collection="$this->getStatus"
        :label="__('forms.status')"
        :required="false"
        :enum="true"
        :translation="true"
        :term="$this->terms['status']"
        name="status"
        wire="terms.status"
        select_wire="form.status"
        field_name="status"
    />

    <x-forms.input.input-price
        :label="__('forms.utility_cost')"
        name="utility_cost"
        :required="true"
        placeholder="Ex : 120,5"
        field_name="utility_cost"
        wire="form.price"
    />

    <x-forms.input.input-text
        :label="__('forms.unit')"
        name="unit"
        :required="true"
        placeholder="Ex: m3, kWh, ..."
        field_name="unit"
        wire="form.unit"
    />
</fieldset>
