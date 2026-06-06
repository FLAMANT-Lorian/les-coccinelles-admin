<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.interventions,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.interventions') }}</span>
        <div class="all-selector">
            <input id="all_interventions_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.interventions.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_interventions_selector">{{ __('general.all') }}</label>
        </div>
    </div>
    <div x-ref="interventions" class="permissions">
        <div class="permission">
            <input id="interventions_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.interventions.index">
            <label for="interventions_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="interventions_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.interventions.create">
            <label for="interventions_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="interventions_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.interventions.edit">
            <label for="interventions_edit">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="interventions_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.interventions.delete">
            <label for="interventions_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
