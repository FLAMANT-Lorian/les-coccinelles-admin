<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.messages,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.message') }}</span>
        <div class="all-selector">
            <label for="all_messages_selector">{{ __('general.all') }}</label>
            <input id="all_messages_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.messages.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
        </div>
    </div>
    <div x-ref="messages" class="permissions">
        <div class="permission">
            <input id="message_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.messages.index">
            <label for="message_index">{{ __('general.see_table') }}</label>
        </div>
        <div class="permission">
            <input id="message_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.messages.edit">
            <label for="message_edit">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="message_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.messages.delete">
            <label for="message_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
