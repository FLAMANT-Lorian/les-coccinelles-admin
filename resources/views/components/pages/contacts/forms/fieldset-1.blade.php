@php
    use App\Enums\YesOrNo;
    use App\Models\User;
@endphp

<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
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
        class="col-span-full"
        :collection="$this->getYesOrNo"
        :label="__('forms.member_card')"
        name="member_card"
        search_wire="terms.member_card"
        select_wire="form.member_card"
        :form_property="$this->form->member_card"
        state="openMemberCardSelectState"
        field_name="member_card"
        :enum="YesOrNo::class"
    />

    <x-forms.input.textarea
        wire="form.address"
        class="col-span-full"
        textarea_class="min-h-40!"
        name="address"
        :required="true"
        field_name="address"
        :label="__('forms.address')"
        :placeholder="__('forms.address_placeholder')"
    />

</fieldset>
