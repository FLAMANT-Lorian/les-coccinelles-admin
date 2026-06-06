<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.events,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.events') }}</span>
        <div class="all-selector">
            <input id="all_events_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.events.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_events_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.events') }}</span></label>
        </div>
    </div>
    <div x-ref="events" class="permissions">
        <div class="permission">
            <input id="events_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.events.index">
            <label for="events_index">{{ __('general.see_table') }} <span class="sr-only">{{ __('navigation/navigation.events') }}</span></label>
        </div>
        <div class="permission">
            <input id="events_show"
                   value="show"
                   type="checkbox"
                   name="show"
                   wire:model.live="form.permissions.events.show">
            <label for="events_show">{{ __('general.show') }} <span class="sr-only">{{ __('navigation/navigation.events') }}</span></label>
        </div>
        <div class="permission">
            <input id="events_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.events.create">
            <label for="events_create">{{ __('general.create') }} <span class="sr-only">{{ __('navigation/navigation.events') }}</span></label>
        </div>
        <div class="permission">
            <input id="events_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.events.edit">
            <label for="events_edit">{{ __('general.update') }} <span class="sr-only">{{ __('navigation/navigation.events') }}</span></label>
        </div>
        <div class="permission">
            <input id="events_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.events.delete">
            <label for="events_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.events') }}</span></label>
        </div>
    </div>
</div>
