@php
    use App\Enums\YesOrNo;
    use App\Models\User;
@endphp

<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        class="col-span-full"
        :label="__('forms.task_name')"
        name="name"
        :required="true"
        :placeholder="__('forms.task_name_placeholder')"
        field_name="name"
        wire="tasksForm.name"
    />

    <x-forms.input.custom-select-simple-db
        class="col-span-full"
        :collection="$this->getMembers"
        :label="__('forms.assignee')"
        name="assignee"
        search_wire="terms.assignee"
        select_wire="tasksForm.assignee"
        :form_property="$this->tasksForm->assignee"
        state="openAssigneeSelectState"
        :model="User::class"
        field_name="assignee"
        :full_name="true"
    />
</fieldset>
