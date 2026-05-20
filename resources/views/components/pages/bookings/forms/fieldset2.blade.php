@php
    use App\Enums\DepositStatus;
    use App\Models\HallRate;
@endphp

<fieldset class="col-span-full">
    <legend>{{ __('pages/hall.bookings-create.fieldset-2') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-x-8 gap-y-6">
        <x-forms.input.input-text
            class="col-span-full"
            :label="__('forms.company-name')"
            name="company_name"
            :placeholder="__('forms.company-name-placeholder')"
            field_name="company_name"
            wire="form.company_name"
        />

        <x-forms.input.custom-select-simple-db
            class="col-span-full"
            :collection="$this->getTypes"
            :label="__('forms.booking-type')"
            name="type"
            search_wire="terms.type"
            select_wire="form.type"
            :form_property="$this->form->type"
            state="typeSelectState"
            :model="HallRate::class"
            field_name="type"
            accessor="type"
        />

        <x-forms.input.custom-select-simple-enum
            class="lg:col-span-3"
            :collection="$this->getDepositStatus"
            :label="__('forms.deposit_status')"
            name="deposit_status"
            search_wire="terms.deposit_status"
            select_wire="form.deposit_status"
            :form_property="$this->form->deposit_status"
            state="depositStatusSelectState"
            field_name="deposit_status"
            :enum="DepositStatus::class"
        />

        <x-forms.input.input-price
            class="lg:col-span-3"
            :label="__('forms.prepayment')"
            name="prepayment"
            placeholder="Ex : 120,5"
            field_name="prepayment"
            wire="form.prepayment"
        />

        <x-forms.input.textarea
            class="lg:col-span-3"
            wire="form.message"
            textarea_class="max-lg:min-h-40!"
            name="message"
            field_name="message"
            :label="__('forms.booking-message')"
            :placeholder="__('forms.booking-message-placeholder')"
        />

        <x-forms.input.textarea
            class="lg:col-span-3"
            wire="form.billing_address"
            textarea_class="min-h-40!"
            name="billing_address"
            :required="true"
            field_name="billing_address"
            :label="__('forms.billing-address')"
            :placeholder="__('forms.address_placeholder')"
        />
    </div>

</fieldset>
