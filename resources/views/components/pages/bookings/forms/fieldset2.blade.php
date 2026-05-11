@php
    use App\Enums\BookingStatus;
    use App\Models\HallRate;
@endphp

<fieldset class="col-span-full">
    <legend>{{ __('pages/hall.bookings-create.fieldset-2') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-x-8 gap-y-6">
        <x-forms.input.custom-select-simple-db
            class="lg:col-span-2"
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
            class="lg:col-span-2"
            :collection="$this->getStatus"
            :label="__('forms.booking-status')"
            name="status"
            search_wire="terms.status"
            select_wire="form.status"
            :form_property="$this->form->status"
            state="statusSelectState"
            field_name="status"
            :enum="BookingStatus::class"
        />

        <x-forms.input.input-date
            class="lg:col-span-2"
            wire="form.start_date"
            name="start_date"
            field_name="start_date"
            :required="true"
            :label="__('forms.start_date')"/>

        <x-forms.input.input-date
            class="lg:col-span-2"
            wire="form.handover_date"
            name="handover_date"
            field_name="handover_date"
            :required="true"
            :label="__('forms.key_handover_date')"/>

        <x-forms.input.input-date
            class="lg:col-span-2"
            wire="form.return_date"
            name="return_date"
            field_name="return_date"
            :required="true"
            :label="__('forms.key_return_date')"/>

        <x-forms.input.input-date
            class="lg:col-span-2"
            wire="form.end_date"
            name="end_date"
            field_name="end_date"
            :required="true"
            :label="__('forms.end_date')"/>

        <x-forms.input.textarea
            class="lg:col-span-3"
            wire="form.message"
            textarea_class="max-lg:min-h-40!"
            name="message"
            :required="true"
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
