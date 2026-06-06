<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.bookings,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.bookings') }}</span>
        <div class="all-selector">
            <input id="all_bookings_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.bookings.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_bookings_selector">{{ __('general.all') }} <span class="sr-only">{{ __('navigation/navigation.bookings') }}</span></label>
        </div>
    </div>
    <div x-ref="bookings" class="permissions">
        <div class="permission">
            <input id="bookings_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.bookings.index">
            <label for="bookings_index">{{ __('general.see_table') }} <span class="sr-only">{{ __('navigation/navigation.bookings') }}</span></label>
        </div>
        <div class="permission">
            <input id="bookings_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.bookings.create">
            <label for="bookings_create">{{ __('general.create') }} <span class="sr-only">{{ __('navigation/navigation.bookings') }}</span></label>
        </div>
        <div class="permission">
            <input id="bookings_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.bookings.edit">
            <label for="bookings_edit">{{ __('general.update') }} <span class="sr-only">{{ __('navigation/navigation.bookings') }}</span></label>
        </div>
        <div class="permission">
            <input id="bookings_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.bookings.delete">
            <label for="bookings_delete">{{ __('general.delete') }} <span class="sr-only">{{ __('navigation/navigation.bookings') }}</span></label>
        </div>
    </div>
</div>
