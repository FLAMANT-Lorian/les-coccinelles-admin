<thead>
    <tr x-data="{ name: 'middle', deadline: 'middle', creator: 'middle', assignee: 'middle'}">
        <th>
            <div class="flex items-center justify-center">
                <input :checked="$wire.selectedColumn.length > 0"
                       type="checkbox" id="all-selector"
                       class="all-selector"
                       @change="
                checkboxes = $refs.table.querySelectorAll(`tbody input[type='checkbox']`);

                let ids = [];

                checkboxes.forEach((checkbox) => {
                if ($event.currentTarget.checked) {
                    checkbox.checked = true;
                    ids.push(checkbox.value);
                } else {
                    checkbox.checked = false;
                    ids = [];
                }
                });
               $wire.set('selectedColumn', ids);
                ">
                <label for="all-selector" class="sr-only">{{ __('tables.select_all') }}</label>
            </div>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (name === 'middle') {
                    deadline = 'middle';
                    creator = 'middle'
                    assignee = 'middle'
                    name = 'desc'
                } else if (name === 'desc') {
                    deadline = 'middle';
                    creator = 'middle'
                    assignee = 'middle'
                    name = 'asc'
                } else if (name === 'asc') {
                    deadline = 'middle';
                    creator = 'middle'
                    assignee = 'middle'
                    name = 'middle'
                }
                $wire.sortBy('name', name)">
                <span>{{ __('tables.intervention-name') }}</span>
                <svg :class="{
                            'rotate-0': name === 'desc',
                            '-rotate-180': name === 'asc',
                            '-rotate-90': name === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (deadline === 'middle') {
                    name = 'middle';
                    creator = 'middle'
                    assignee = 'middle'
                    deadline = 'desc'
                } else if (deadline === 'desc') {
                    name = 'middle';
                    creator = 'middle'
                    assignee = 'middle'
                    deadline = 'asc'
                } else if (deadline === 'asc') {
                    name = 'middle';
                    creator = 'middle'
                    assignee = 'middle'
                    deadline = 'middle'
                }
                $wire.sortBy('deadline', deadline)">
                <span>{{ __('tables.deadline') }}</span>
                <svg :class="{
                            'rotate-0': deadline === 'desc',
                            '-rotate-180': deadline === 'asc',
                            '-rotate-90': deadline === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (creator === 'middle') {
                    name = 'middle';
                    deadline = 'middle'
                    assignee = 'middle'
                    creator = 'desc'
                } else if (creator === 'desc') {
                    name = 'middle';
                    deadline = 'middle'
                    assignee = 'middle'
                    creator = 'asc'
                } else if (creator === 'asc') {
                    name = 'middle';
                    deadline = 'middle'
                    assignee = 'middle'
                    creator = 'middle'
                }
                $wire.sortBy('creator.first_name', creator)">
                <span>{{ __('tables.creator') }}</span>
                <svg :class="{
                            'rotate-0': creator === 'desc',
                            '-rotate-180': creator === 'asc',
                            '-rotate-90': creator === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (assignee === 'middle') {
                    name = 'middle';
                    deadline = 'middle'
                    creator = 'middle'
                    assignee = 'desc'
                } else if (assignee === 'desc') {
                    name = 'middle';
                    deadline = 'middle'
                    creator = 'middle'
                    assignee = 'asc'
                } else if (assignee === 'asc') {
                    name = 'middle';
                    deadline = 'middle'
                    creator = 'middle'
                    assignee = 'middle'
                }
                $wire.sortBy('assignee.first_name', assignee)">
                <span>{{ __('tables.assignee') }}</span>
                <svg :class="{
                            'rotate-0': assignee === 'desc',
                            '-rotate-180': assignee === 'asc',
                            '-rotate-90': assignee === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <span>{{ __('tables.status') }}</span>
        </th>
        <th data-action>{{ __('tables.actions') }}</th>
    </tr>
</thead>
