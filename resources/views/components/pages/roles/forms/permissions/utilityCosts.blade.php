<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.utilityCosts,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.utilityCosts') }}</span>
        <div class="all-selector">
            <label for="all_utilityCosts_selector">{{ __('general.all') }}</label>
            <input id="all_utilityCosts_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.utilityCosts.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="utilityCosts" class="permissions">
        <div class="permission">
            <input id="utilityCosts_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.utilityCosts.index">
            <label for="utilityCosts_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="utilityCosts_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.utilityCosts.create">
            <label for="utilityCosts_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="utilityCosts_update"
                   value="update"
                   type="checkbox"
                   name="update"
                   wire:model.live="form.permissions.utilityCosts.update">
            <label for="utilityCosts_update">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="utilityCosts_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.utilityCosts.delete">
            <label for="utilityCosts_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
