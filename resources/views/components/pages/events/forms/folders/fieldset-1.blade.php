@php
    use App\Enums\YesOrNo;
    use App\Models\User;
@endphp

<fieldset class="grid! rg:grid-cols-2 gap-6! border-b-0!">
    <x-forms.input.input-text
        class="max-rg:col-span-full"
        :label="__('forms.folder_name')"
        name="name"
        :required="true"
        :placeholder="__('forms.folder_name_placeholder')"
        field_name="name"
        wire="foldersForm.name"
    />

    <x-forms.input.input-text
        class="max-rg:col-span-full"
        :label="__('forms.folder_color')"
        type="color"
        name="color"
        field_name="color"
        wire="foldersForm.color"
    />
</fieldset>
