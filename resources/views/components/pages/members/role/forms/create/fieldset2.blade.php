<fieldset>
    <legend>{{ __('pages/members.role-fieldset-2') }}</legend>
    <div class="permissions-container">
        <div class="permission-card">
            <div class="heading">
                <span class="title">Membres</span>
                <div class="all-selector">
                    <label for="all_selector">Tout</label>
                    <input id="all_selector"
                           type="checkbox"
                           :checked="$wire.membersOptions.length === 4"
                           @change="
                        const permissions = $refs.permissions.querySelectorAll('input')

                        let ids = [];

                        permissions.forEach((permission) => {
                         if ($event.currentTarget.checked) {
                            permission.checked = true;
                            ids.push(permission.value);
                        } else {
                            permission.checked = false;
                            ids = [];
                        }
                        $wire.membersOptions = ids;
                        });">
                </div>
            </div>
            <div x-ref="permissions" class="permissions">
                <div class="permission">
                    <input id="members_index"
                           value="index"
                           type="checkbox"
                           @click=""
                           wire:model.live="membersOptions">
                    <label for="members_index">Voir le tableau</label>
                </div>
                <div class="permission">
                    <input id="members_create"
                           value="create"
                           type="checkbox"
                           @click=""
                           wire:model.live="membersOptions">
                    <label for="members_create">Créer</label>
                </div>
                <div class="permission">
                    <input id="members_edit"
                           value="edit"
                           type="checkbox"
                           @click=""
                           wire:model.live="membersOptions">
                    <label for="members_edit">Modifier</label>
                </div>
                <div class="permission">
                    <input id="members_delete"
                           value="delete"
                           type="checkbox"
                           @click=""
                           wire:model.live="membersOptions">
                    <label for="members_delete">Supprimer</label>
                </div>
            </div>
        </div>
    </div>
</fieldset>
