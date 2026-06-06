<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.roles,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.roles') }}</span>
        <div class="all-selector">
            <input id="all_roles_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.roles.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_roles_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.roles') }}</span></label>
        </div>
    </div>
    <div x-ref="roles" class="permissions">
        <div class="permission">
            <input id="roles_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.roles.index">
            <label for="roles_index">{{ __('general.see_table') }} <span class="sr-only">{{ __('navigation/navigation.roles') }}</span></label>
        </div>
        <div class="permission">
            <input id="roles_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.roles.create">
            <label for="roles_create">{{ __('general.create') }} <span class="sr-only">{{ __('navigation/navigation.roles') }}</span></label>
        </div>
        <div class="permission">
            <input id="roles_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.roles.edit">
            <label for="roles_edit">{{ __('general.update') }} <span class="sr-only">{{ __('navigation/navigation.roles') }}</span></label>
        </div>
        <div class="permission">
            <input id="roles_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.roles.delete">
            <label for="roles_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.roles') }}</span></label>
        </div>
    </div>
</div>
