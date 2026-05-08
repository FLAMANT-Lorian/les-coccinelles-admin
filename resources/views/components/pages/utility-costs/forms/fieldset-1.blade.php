@php
    use App\Enums\UtilityCostsStatus;
@endphp
<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        :label="__('forms.type')"
        name="type"
        :required="true"
        :placeholder="__('forms.type_placeholder')"
        field_name="type"
        wire="form.type"
    />

    <x-forms.input.custom-select-simple-enum
        :collection="$this->getStatus"
        :label="__('forms.status')"
        name="status"
        search_wire="terms.status"
        select_wire="form.status"
        :form_property="$this->form->status"
        state="statusSelectState"
        field_name="status"
        :enum="UtilityCostsStatus::class"
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
