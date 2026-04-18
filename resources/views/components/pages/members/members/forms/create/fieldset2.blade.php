<fieldset class="col-span-full lg:col-start-4 lg:col-span-9 lg:p-0!">
    <legend>{{ __('pages/members.base') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6">
        <x-forms.input.input-text
            name="last_name"
            wire="form.last_name"
            field_name="last_name"
            :label="__('forms.last_name')"
            placeholder="Doe"/>

        <x-forms.input.input-text
            wire="form.first_name"
            name="first_name"
            field_name="first_name"
            :label="__('forms.first_name')"
            placeholder="John"/>

        <x-forms.input.input-text
            wire="form.email"
            name="email"
            field_name="email"
            type="email"
            :label="__('forms.email')"
            placeholder="johndoe@example.com"
            :required="true"/>

        <x-forms.input.input-text
            wire="form.phone"
            name="phone"
            field_name="phone"
            type="tel"
            :label="__('forms.phone')"
            placeholder="+XX XXX XX XX XX"
            :required="true"/>

        <x-forms.input.input-text
            wire="form.city"
            name="city"
            field_name="city"
            :label="__('forms.city')"
            placeholder="Bruxelles"
            :required="true"/>

        <x-forms.input.input-text
            wire="form.postal_code"
            name="postal_code"
            field_name="postal_code"
            type="number"
            :label="__('forms.postal-code')"
            placeholder="4000"
            :required="true"/>

        <x-forms.input.custom-select-simple
            :collection="$this->getSex"
            :label="__('forms.sex')"
            :required="false"
            :enum="true"
            :translation="true"
            :term="$this->terms['sex']"
            name="sex"
            wire="terms.sex"
            select_wire="form.sex"
            field_name="sex"
        />

        <x-forms.input.input-date
            wire="form.birth_date"
            name="birth_date"
            field_name="birth_date"
            :label="__('forms.birth-date')"/>

        <x-forms.input.custom-select-simple
            :collection="$this->getRoles"
            :label="__('forms.role')"
            :multiple="false"
            :enum="false"
            :translation="false"
            accessor="name"
            :term="$this->terms['role']"
            name="role"
            wire="terms.role"
            select_wire="form.role"
            field_name="role"
        />

        <x-forms.input.custom-select-simple
            :collection="$this->getStatus"
            :label="__('forms.status')"
            :multiple="false"
            :required="true"
            :enum="true"
            :translation="true"
            :term="$this->terms['status']"
            name="status"
            wire="terms.status"
            select_wire="form.status"
            field_name="status"
        />

        <x-forms.input.textarea
            wire="form.address"
            class="md:row-span-2 lg:col-start-3 lg:row-start-3"
            name="address"
            field_name="address"
            :label="__('forms.address')"
            placeholder="Chaussée du vieux moulin, ..."
            :required="true"/>
    </div>

</fieldset>
