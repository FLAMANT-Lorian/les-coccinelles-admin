<div class="permission-card"
     x-data="{
         perms: $wire.form.permissions.tasks,
         allSelected() {
             const values = Object.values(this.perms);
             return values.every(v => v === true);
         },
     }">
    <div class="heading">
        <span class="title">{{ __('general.permissions.tasks') }}</span>
        <div class="all-selector">
            <input id="all_tasks_selector"
                   type="checkbox"
                   :checked="allSelected"
                   @change="
                        const permissions = $refs.tasks.querySelectorAll('input')

                        permissions.forEach((permission) => {

                        $event.currentTarget.checked ? permission.checked = true : permission.checked = false;

                        permission.dispatchEvent(new Event('change'));
                        });">
            <label for="all_tasks_selector">{{ __('general.all') }}</label>
        </div>
    </div>
    <div x-ref="tasks" class="permissions">
        <div class="permission">
            <input id="tasks_index"
                   value="index"
                   type="checkbox"
                   name="index"
                   wire:model.live="form.permissions.tasks.index">
            <label for="tasks_index">{{ __('general.see_list') }}</label>
        </div>
        <div class="permission">
            <input id="tasks_create"
                   value="create"
                   type="checkbox"
                   name="create"
                   wire:model.live="form.permissions.tasks.create">
            <label for="tasks_create">{{ __('general.create') }}</label>
        </div>
        <div class="permission">
            <input id="tasks_edit"
                   value="edit"
                   type="checkbox"
                   name="edit"
                   wire:model.live="form.permissions.tasks.edit">
            <label for="tasks_edit">{{ __('general.update') }}</label>
        </div>
        <div class="permission">
            <input id="tasks_delete"
                   value="delete"
                   type="checkbox"
                   name="delete"
                   wire:model.live="form.permissions.tasks.delete">
            <label for="tasks_delete">{{ __('general.delete') }}</label>
        </div>
    </div>
</div>
