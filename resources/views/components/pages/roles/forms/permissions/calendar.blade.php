<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.calendar,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.calendar') }}</span>
        <div class="all-selector">
            <label for="all_calendar_selector">{{ __('general.all') }}</label>
            <input id="all_calendar_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.calendar.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="calendar" class="permissions">
        <div class="permission">
            <input id="calendar_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.calendar.index">
            <label for="calendar_index">{{ __('general.see_calendar') }}</label>
        </div>
    </div>
</div>
