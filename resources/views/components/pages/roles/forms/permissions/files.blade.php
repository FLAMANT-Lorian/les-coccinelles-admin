<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.files,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.files') }}</span>
        <div class="all-selector">
            <input id="all_files_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.files.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_files_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.files') }}</span></label>
        </div>
    </div>
    <div x-ref="files" class="permissions">
        <div class="permission">
            <input id="files_add"
                   value="add"
                   type="checkbox"
                   name="add"
                   wire:model.live="form.permissions.files.add">
            <label for="files_add">{{ __('general.add') }} <span class="sr-only">{{ __('navigation/navigation.files') }}</span></label>
        </div>
        <div class="permission">
            <input id="files_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.files.delete">
            <label for="files_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.files') }}</span></label>
        </div>
    </div>
</div>
