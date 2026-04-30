<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.members,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.members') }}</span>
        <div class="all-selector">
            <label for="all_members_selector">Tout</label>
            <input id="all_members_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.members.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="members" class="permissions">
        <div class="permission">
            <input id="members_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.members.index">
            <label for="members_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="members_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.members.create">
            <label for="members_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="members_update"
                   value="update"
                   type="checkbox"
                   name="update"
                   wire:model.live="form.permissions.members.update">
            <label for="members_update">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="members_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.members.delete">
            <label for="members_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
