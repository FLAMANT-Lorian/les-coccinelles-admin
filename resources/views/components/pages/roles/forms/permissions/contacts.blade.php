<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.contacts,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.contacts') }}</span>
        <div class="all-selector">
            <label for="all_contacts_selector">{{ __('general.all') }}</label>
            <input id="all_contacts_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.contacts.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="contacts" class="permissions">
        <div class="permission">
            <input id="contacts_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.contacts.index">
            <label for="contacts_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="contacts_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.contacts.create">
            <label for="contacts_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="contacts_update"
                   value="update"
                   type="checkbox"
                   name="update"
                   wire:model.live="form.permissions.contacts.update">
            <label for="contacts_update">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="contacts_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.contacts.delete">
            <label for="contacts_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
