@php
    use App\Enums\YesOrNo;
    use App\Models\User;
@endphp

<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        class="col-span-full"
        :label="__('forms.event_name')"
        name="name"
        :required="true"
        placeholder="Doe"
        field_name="name"
        wire="form.name"
    />

    <x-forms.input.input-date
        :label="__('forms.start_date')"
        :placeholder="__('forms.booking-dates-placeholder')"
        name="start_date"
        :required="true"
        field_name="start_date"
        wire="form.start_date"/>

    <x-forms.input.input-date
        :label="__('forms.end_date')"
        :placeholder="__('forms.booking-dates-placeholder')"
        name="end_date"
        :required="true"
        field_name="end_date"
        wire="form.end_date"/>

    <x-forms.input.textarea
        wire="form.address"
        class="col-span-1 col-start-2 row-start-2 row-span-2"
        textarea_class="min-h-40!"
        name="address"
        :required="true"
        field_name="address"
        :label="__('forms.address')"
        :placeholder="__('forms.address_placeholder')"
    />

    <x-forms.input.textarea
        wire="form.description"
        class="col-span-full"
        textarea_class="min-h-40!"
        name="description"
        :required="true"
        field_name="description"
        :label="__('forms.description')"
        :placeholder="__('forms.description_placeholder')"
    />

</fieldset>
