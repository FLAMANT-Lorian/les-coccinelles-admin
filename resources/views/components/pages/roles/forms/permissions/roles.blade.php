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
            <label for="all_roles_selector">{{ __('general.all') }}</label>
            <input id="all_roles_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.roles.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="roles" class="permissions">
        <div class="permission">
            <input id="roles_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.roles.index">
            <label for="roles_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="roles_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.roles.create">
            <label for="roles_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="roles_update"
                   value="update"
                   type="checkbox"
                   name="update"
                   wire:model.live="form.permissions.roles.update">
            <label for="roles_update">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="roles_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.roles.delete">
            <label for="roles_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
