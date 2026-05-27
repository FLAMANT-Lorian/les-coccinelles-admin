<thead>
    <tr x-data="{ name: 'middle', date: 'middle' }">
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
                    date = 'middle';
                    name = 'desc'
                } else if (name === 'desc') {
                     date = 'middle';
                    name = 'asc'
                } else if (name === 'asc') {
                     date = 'middle';
                    name = 'middle'
                }
                $wire.sortBy('name', name)">
                <span>{{ __('tables.full_name') }}</span>
                <svg :class="{
                            'rotate-0': name === 'desc',
                            '-rotate-180': name === 'asc',
                            '-rotate-90': name === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"/>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (date === 'middle') {
                    name = 'middle';
                    date = 'desc'
                } else if (date === 'desc') {
                     name = 'middle';
                    date = 'asc'
                } else if (date === 'asc') {
                     name = 'middle';
                    date = 'middle'
                }
                $wire.sortBy('start_date', date)">
                <span>{{ __('tables.events_dates') }}</span>
                <svg :class="{
                            'rotate-0': date === 'desc',
                            '-rotate-180': date === 'asc',
                            '-rotate-90': date === 'middle'
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
