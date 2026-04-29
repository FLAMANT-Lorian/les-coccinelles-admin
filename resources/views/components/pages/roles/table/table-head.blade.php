<thead>
    <tr x-data="{ role: 'middle', name: 'middle', email: 'middle' }">
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
            if (role === 'middle') {
                    name = 'middle';
                    email = 'middle';
                    role = 'desc'
                } else if (role === 'desc') {
                     name = 'middle';
                    email = 'middle';
                    role = 'asc'
                } else if (role === 'asc') {
                     name = 'middle';
                    email = 'middle';
                    role = 'middle'
                }
                $wire.sortBy('name', role)">
                <span>{{ __('tables.role') }}</span>
                <svg :class="{
                            'rotate-0': role === 'desc',
                            '-rotate-180': role === 'asc',
                            '-rotate-90': role === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <span>{{ __('tables.unique_role') }}</span>
        </th>
        <th>
            <span>{{ __('tables.full_name') }}</span>
        </th>
        <th>
            <span>{{ __('tables.email') }}</span>
        </th>
        <th data-action>{{ __('tables.actions') }}</th>
    </tr>
</thead>
