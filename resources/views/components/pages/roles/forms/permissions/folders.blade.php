<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.folders,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.folders') }}</span>
        <div class="all-selector">
            <input id="all_folders_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.folders.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_folders_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.folders') }}</span></label>
        </div>
    </div>
    <div x-ref="folders" class="permissions">
        <div class="permission">
            <input id="folders_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.folders.index">
            <label for="folders_index">{{ __('general.see_folders') }} <span class="sr-only">{{ __('navigation/navigation.folders') }}</span></label>
        </div>
        <div class="permission">
            <input id="folders_show"
                   value="show"
                   type="checkbox"
                   name="show"
                   wire:model.live="form.permissions.folders.show">
            <label for="folders_show">{{ __('general.see_inside_folders') }} <span class="sr-only">{{ __('navigation/navigation.folders') }}</span></label>
        </div>
        <div class="permission">
            <input id="folders_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.folders.create">
            <label for="folders_create">{{ __('general.create') }} <span class="sr-only">{{ __('navigation/navigation.folders') }}</span></label>
        </div>
        <div class="permission">
            <input id="folders_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.folders.edit">
            <label for="folders_edit">{{ __('general.update') }} <span class="sr-only">{{ __('navigation/navigation.folders') }}</span></label>
        </div>
        <div class="permission">
            <input id="folders_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.folders.delete">
            <label for="folders_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.folders') }}</span></label>
        </div>
    </div>
</div>
