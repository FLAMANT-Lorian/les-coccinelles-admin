<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.availabilities,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.availabilities') }}</span>
        <div class="all-selector">
            <input id="all_availabilities_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.availabilities.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_availabilities_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.availabilities') }}</span></label>
        </div>
    </div>
    <div x-ref="availabilities" class="permissions">
        <div class="permission">
            <input id="availabilities_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.availabilities.index">
            <label for="availabilities_index">{{ __('general.see_table') }} <span class="sr-only">{{ __('navigation/navigation.availabilities') }}</span></label>
        </div>
        <div class="permission">
            <input id="availabilities_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.availabilities.edit">
            <label for="availabilities_edit">{{ __('general.update') }} <span class="sr-only">{{ __('navigation/navigation.availabilities') }}</span></label>
        </div>
        <div class="permission">
            <input id="availabilities_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.availabilities.delete">
            <label for="availabilities_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.availabilities') }}</span></label>
        </div>
    </div>
</div>
