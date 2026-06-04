@php
    use App\Models\Contact;
    use App\Enums\YesOrNo;
@endphp

<fieldset class="col-span-full gap-8!">
    <legend>{{ __('pages/hall.bookings-create.fieldset-1') }}</legend>
    <div class="grid grid-cols-1">
        <x-forms.input.custom-select-simple-db
            :collection="$this->getContacts"
            :label="__('forms.tenant')"
            name="tenant"
            search_wire="terms.tenant"
            select_wire="form.tenant"
            :form_property="$this->form->tenant"
            state="tenantSelectState"
            :model="Contact::class"
            field_name="tenant"
            :full_name="true"
        />
    </div>
    @if(!$this->form->tenant)
        <div class="flex flex-row gap-6 items-center">
            <span class="w-full h-px block bg-beige-dark/60"></span>
            <span class="text-lg text-brown">{{ __('general.or') }}</span>
            <span class="w-full h-px block bg-beige-dark/60"></span>
        </div>
        <div class="p-4 lg:p-6 border border-beige-dark rounded-sm">
            <div class="flex flex-col gap-1 mb-6">
                <span class="text-xl font-medium text-brown">{{ __('forms.add-contact-from-booking') }}</span>
                <span class="paragraph text-gray-500">{{ __('forms.add-contact-message-from-booking') }}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6">
                <x-forms.input.input-text
                    :label="__('forms.last_name')"
                    name="last_name"
                    :required="true"
                    placeholder="Doe"
                    field_name="last_name"
                    wire="form.last_name"
                />

                <x-forms.input.input-text
                    :label="__('forms.first_name')"
                    name="first_name"
                    :required="true"
                    placeholder="John"
                    field_name="first_name"
                    wire="form.first_name"
                />

                <x-forms.input.input-text
                    type="email"
                    :label="__('forms.email')"
                    name="email"
                    :required="true"
                    placeholder="johndoe@example.be"
                    field_name="email"
                    wire="form.email"
                />

                <x-forms.input.input-text
                    type="tel"
                    :label="__('forms.phone')"
                    name="phone"
                    :required="true"
                    placeholder="+XX XXX XX XX XX"
                    field_name="phone"
                    wire="form.phone"
                />

                <x-forms.input.custom-select-simple-enum
                    class="col-span-full lg:col-start-1 lg:col-span-1"
                    :collection="$this->getYesOrNo"
                    :label="__('forms.member_card')"
                    name="member_card"
                    search_wire="terms.member_card"
                    select_wire="form.member_card"
                    :form_property="$this->form->member_card"
                    state="memberCardSelectState"
                    field_name="member_card"
                    :enum="YesOrNo::class"
                />

                <x-forms.input.textarea
                    class="col-span-full lg:col-start-2 lg:row-start-2 lg:row-span-2"
                    wire="form.address"
                    textarea_class="max-lg:min-h-40!"
                    name="address"
                    :required="true"
                    field_name="address"
                    :label="__('forms.address')"
                    :placeholder="__('forms.address_placeholder')"
                />
            </div>
        </div>
    @endif

</fieldset>
