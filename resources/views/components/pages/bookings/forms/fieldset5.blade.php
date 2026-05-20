@php
    use App\Enums\BookingStatus;
    use App\Models\HallRate;
@endphp

<fieldset class="col-span-full border-b-0!">
    <legend>{{ __('pages/hall.bookings-create.fieldset-5') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-x-8 gap-y-6">
        <x-forms.input.input-price
            class="lg:col-span-3"
            :label="__('forms.cleaning')"
            name="cleaning"
            placeholder="Ex : 120,5"
            field_name="cleaning"
            wire="form.cleaning"
        />
        <x-forms.input.input-price
            class="lg:col-span-3"
            :label="__('forms.breaking')"
            name="breaking"
            placeholder="Ex : 120,5"
            field_name="breaking"
            wire="form.breaking"
        />
    </div>

</fieldset>
