@php
    use App\Models\User;
    use App\Enums\InterventionStatus;
@endphp

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

    <x-forms.input.custom-select-simple-db
        class="col-span-full"
        :collection="$this->getMembers"
        :label="__('forms.assignee')"
        name="assignee"
        search_wire="terms.assignee"
        select_wire="form.assignee"
        :form_property="$this->form->assignee"
        state="openAssigneeSelectState"
        :model="User::class"
        field_name="assignee"
        :full_name="true"
    />

    <x-forms.input.custom-select-simple-enum
        :collection="$this->getStatus"
        :label="__('forms.status')"
        name="status"
        search_wire="terms.status"
        select_wire="form.status"
        :form_property="$this->form->status"
        state="openStatusSelectState"
        field_name="status"
        :enum="InterventionStatus::class"
    />

    <x-forms.input.input-date
        :label="__('forms.deadline')"
        :placeholder="__('forms.booking-dates-placeholder')"
        name="deadline"
        :required="true"
        field_name="deadline"
        wire="form.deadline"/>

    <x-forms.input.textarea
        wire="form.description"
        class="col-span-full"
        textarea_class="min-h-40!"
        name="description"
        field_name="description"
        :label="__('forms.more_information')"
        :placeholder="__('forms.more_information')"
    />

</fieldset>
