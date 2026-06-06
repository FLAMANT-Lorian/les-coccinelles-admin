<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.meetings,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.meetings') }}</span>
        <div class="all-selector">
            <input id="all_meetings_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.meetings.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_meetings_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.meetings') }}</span></label>
        </div>
    </div>
    <div x-ref="meetings" class="permissions">
        <div class="permission">
            <input id="meetings_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.meetings.index">
            <label for="meetings_index">{{ __('general.see_table') }} <span class="sr-only">{{ __('navigation/navigation.meetings') }}</span></label>
        </div>
        <div class="permission">
            <input id="meetings_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.meetings.create">
            <label for="meetings_create">{{ __('general.create') }} <span class="sr-only">{{ __('navigation/navigation.meetings') }}</span></label>
        </div>
        <div class="permission">
            <input id="meetings_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.meetings.edit">
            <label for="meetings_edit">{{ __('general.update') }} <span class="sr-only">{{ __('navigation/navigation.meetings') }}</span></label>
        </div>
        <div class="permission">
            <input id="meetings_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.meetings.delete">
            <label for="meetings_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.meetings') }}</span></label>
        </div>
    </div>
</div>
