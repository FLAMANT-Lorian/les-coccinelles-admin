<div class="permission-card">
    <div class="heading">
        <span class="title">Membres</span>
        <div class="all-selector">
            <label for="all_selector">Tout</label>
            <input id="all_selector"
                   type="checkbox"
                   :checked="$wire.messageOptions.length === 4"
                   @change="
                        const permissions = $refs.permissions.querySelectorAll('input')

                        permissions.forEach((permission) => {
                         if ($event.currentTarget.checked) {
                            permission.checked = true;
                        } else {
                            permission.checked = false;
                        }
                        });">
        </div>
    </div>
    <div x-ref="permissions" class="permissions">
        <div class="permission">
            <input id="message_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.messages.index">
            <label for="message_index">Voir le tableau</label>
        </div>
        <div class="permission">
            <input id="message_delete"
                   value="index"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.messages.delete">
            <label for="message_delete">Supprimer</label>
        </div>
    </div>
</div>
