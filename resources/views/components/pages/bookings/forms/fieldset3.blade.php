@php
    use App\Enums\BookingStatus;
    use App\Models\HallRate;
@endphp

<fieldset class="col-span-full">
    <legend>{{ __('pages/hall.bookings-create.fieldset-3') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-x-8 gap-y-6">
        <x-forms.input.input-date
            class="col-span-full"
            :label="__('forms.booking-dates')"
            :placeholder="__('forms.booking-dates-placeholder')"
            name="dates"
            :date_range="true"
            :required="true"
            field_name="dates"
            wire="form.dates"
            :disabled="$this->getDisabledDates"
        />

        <x-forms.input.input-date
            class="lg:col-span-3"
            :label="__('forms.key_handover_date')"
            :placeholder="__('forms.booking-dates-placeholder')"
            name="handover_date"
            :required="true"
            field_name="handover_date"
            wire="form.handover_date"/>

        <x-forms.input.input-text
            class="lg:col-span-3"
            type="time"
            :label="__('forms.key_handover_hour')"
            name="handover_hour"
            :required="true"
            field_name="handover_hour"
            wire="form.handover_hour"
        />

        <x-forms.input.input-date
            class="lg:col-span-3"
            :label="__('forms.key_return_date')"
            :placeholder="__('forms.booking-dates-placeholder')"
            name="return_date"
            :required="true"
            field_name="return_date"
            wire="form.return_date"/>

        <x-forms.input.input-text
            class="lg:col-span-3"
            type="time"
            :label="__('forms.key_return_hour')"
            name="return_hour"
            :required="true"
            field_name="return_hour"
            wire="form.return_hour"
        />
    </div>

</fieldset>
