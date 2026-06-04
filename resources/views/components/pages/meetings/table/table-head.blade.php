<thead>
    <tr x-data="{ numero: 'middle', address: 'middle', date: 'middle', hour: 'middle'}">
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
            if (numero === 'middle') {
                    address = 'middle';
                    date = 'middle'
                    hour = 'middle'
                    numero = 'desc'
                } else if (numero === 'desc') {
                    address = 'middle';
                    date = 'middle'
                    hour = 'middle'
                    numero = 'asc'
                } else if (numero === 'asc') {
                    address = 'middle';
                    date = 'middle'
                    hour = 'middle'
                    numero = 'middle'
                }
                $wire.sortBy('id', numero)">
                <span>{{ __('tables.number') }}</span>
                <svg :class="{
                            'rotate-0': numero === 'desc',
                            '-rotate-180': numero === 'asc',
                            '-rotate-90': numero === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (address === 'middle') {
                    numero = 'middle';
                    date = 'middle'
                    hour = 'middle'
                    address = 'desc'
                } else if (address === 'desc') {
                    numero = 'middle';
                    date = 'middle'
                    hour = 'middle'
                    address = 'asc'
                } else if (address === 'asc') {
                    numero = 'middle';
                    date = 'middle'
                    hour = 'middle'
                    address = 'middle'
                }
                $wire.sortBy('address', address)">
                <span>{{ __('tables.address') }}</span>
                <svg :class="{
                            'rotate-0': address === 'desc',
                            '-rotate-180': address === 'asc',
                            '-rotate-90': address === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (date === 'middle') {
                    numero = 'middle';
                    deadline = 'middle'
                    hour = 'middle'
                    date = 'desc'
                } else if (date === 'desc') {
                    numero = 'middle';
                    deadline = 'middle'
                    hour = 'middle'
                    date = 'asc'
                } else if (date === 'asc') {
                    numero = 'middle';
                    deadline = 'middle'
                    hour = 'middle'
                    date = 'middle'
                }
                $wire.sortBy('date', date)">
                <span>{{ __('tables.date') }}</span>
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
            <button type="button" class="flex items-center gap-2" @click="
            if (hour === 'middle') {
                    numero = 'middle';
                    deadline = 'middle'
                    date = 'middle'
                    hour = 'desc'
                } else if (hour === 'desc') {
                    numero = 'middle';
                    deadline = 'middle'
                    date = 'middle'
                    hour = 'asc'
                } else if (hour === 'asc') {
                    numero = 'middle';
                    deadline = 'middle'
                    date = 'middle'
                    hour = 'middle'
                }
                $wire.sortBy('hour', hour)">
                <span>{{ __('tables.hour') }}</span>
                <svg :class="{
                            'rotate-0': hour === 'desc',
                            '-rotate-180': hour === 'asc',
                            '-rotate-90': hour === 'middle'
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
