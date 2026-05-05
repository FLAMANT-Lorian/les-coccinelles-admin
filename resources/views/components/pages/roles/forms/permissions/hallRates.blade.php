<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.hallRates,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.hallRates') }}</span>
        <div class="all-selector">
            <label for="all_hallRates_selector">{{ __('general.all') }}</label>
            <input id="all_hallRates_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.hallRates.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="hallRates" class="permissions">
        <div class="permission">
            <input id="hallRates_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.hallRates.index">
            <label for="hallRates_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="hallRates_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.hallRates.create">
            <label for="hallRates_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="hallRates_update"
                   value="update"
                   type="checkbox"
                   name="update"
                   wire:model.live="form.permissions.hallRates.update">
            <label for="hallRates_update">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="hallRates_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.hallRates.delete">
            <label for="hallRates_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
