<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        class="col-span-full"
        :label="__('forms.intervention')"
        name="name"
        :required="true"
        :placeholder="__('forms.intervention_placeholder')"
        field_name="name"
        wire="form.name"
    />

    <x-forms.input.textarea
        wire="form.description"
        class="col-span-full"
        textarea_class="min-h-40!"
        name="description"
        field_name="description"
        :label="__('forms.more_information')"
        :placeholder="__('forms.more_information')"
        :required="true"/>

    <x-forms.input.custom-select-simple-db
        class="col-span-full"
        :collection="$this->getMembers"
        :label="__('forms.assignee')"
        :multiple="false"
        accessor="first_name"
        :term="$this->terms['assignee']"
        name="assignee"
        wire="terms.assignee"
        select_wire="form.assignee"
        field_name="assignee"
        :full_name="true"
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

    <x-forms.input.input-date
        wire="form.deadline"
        name="deadline"
        field_name="deadline"
        :label="__('forms.deadline')"/>

</fieldset>
