<thead>
    <tr x-data="{ name: 'middle', email: 'middle', send_date: 'middle' }">
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
                    email = 'middle';
                    send_date = 'middle';
                    name = 'desc'
                } else if (name === 'desc') {
                     email = 'middle';
                    send_date = 'middle';
                    name = 'asc'
                } else if (name === 'asc') {
                     email = 'middle';
                    send_date = 'middle';
                    name = 'middle'
                }
                $wire.sortBy('first_name', name)">
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
            if (email === 'middle') {
                    name = 'middle';
                    send_date = 'middle';
                    email = 'desc'
                } else if (email === 'desc') {
                     name = 'middle';
                    send_date = 'middle';
                    email = 'asc'
                } else if (email === 'asc') {
                     name = 'middle';
                    send_date = 'middle';
                    email = 'middle'
                }
                $wire.sortBy('email', email)">
                <span>{{ __('tables.email') }}</span>
                <svg :class="{
                            'rotate-0': email === 'desc',
                            '-rotate-180': email === 'asc',
                            '-rotate-90': email === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2"  @click="
            if (send_date === 'middle') {
                    email = 'middle';
                    name = 'middle';
                    send_date = 'desc'
                } else if (send_date === 'desc') {
                     email = 'middle';
                    name = 'middle';
                    send_date = 'asc'
                } else if (send_date === 'asc') {
                     email = 'middle';
                    name = 'middle';
                    send_date = 'middle'
                }
                $wire.sortBy('created_at', send_date)">
                <span>{{ __('tables.send_date') }}</span>
                <svg :class="{
                            'rotate-0': send_date === 'desc',
                            '-rotate-180': send_date === 'asc',
                            '-rotate-90': send_date === 'middle'
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
