<thead>
    <tr x-data="{ name: 'middle', start_date: 'middle', type: 'middle' }">
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
                    start_date = 'middle';
                    type = 'middle';
                    name = 'desc'
                } else if (name === 'desc') {
                     start_date = 'middle';
                    type = 'middle';
                    name = 'asc'
                } else if (name === 'asc') {
                     start_date = 'middle';
                    type = 'middle';
                    name = 'middle'
                }
                $wire.sortBy('contact.first_name', name)">
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
            if (start_date === 'middle') {
                    name = 'middle';
                    type = 'middle';
                    start_date = 'desc'
                } else if (start_date === 'desc') {
                     name = 'middle';
                    type = 'middle';
                    start_date = 'asc'
                } else if (start_date === 'asc') {
                     name = 'middle';
                    type = 'middle';
                    start_date = 'middle'
                }
                $wire.sortBy('date.start_date', start_date)">
                <span>{{ __('tables.dates') }}</span>
                <svg :class="{
                            'rotate-0': start_date === 'desc',
                            '-rotate-180': start_date === 'asc',
                            '-rotate-90': start_date === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2"  @click="
            if (type === 'middle') {
                    start_date = 'middle';
                    name = 'middle';
                    type = 'desc'
                } else if (type === 'desc') {
                     start_date = 'middle';
                    name = 'middle';
                    type = 'asc'
                } else if (type === 'asc') {
                     start_date = 'middle';
                    name = 'middle';
                    type = 'middle'
                }
                $wire.sortBy('hall_rate.type', type)">
                <span>{{ __('tables.type') }}</span>
                <svg :class="{
                            'rotate-0': type === 'desc',
                            '-rotate-180': type === 'asc',
                            '-rotate-90': type === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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
