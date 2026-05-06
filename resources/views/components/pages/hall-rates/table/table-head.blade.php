<thead>
    <tr x-data="{ name: 'middle', base_price: 'middle', member_price: 'middle' }">
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
                    base_price = 'middle';
                    member_price = 'middle';
                    name = 'desc'
                } else if (name === 'desc') {
                    base_price = 'middle';
                    member_price = 'middle';
                    name = 'asc'
                } else if (name === 'asc') {
                    base_price = 'middle';
                    member_price = 'middle';
                    name = 'middle'
                }
                $wire.sortBy('type', name)">
                <span>{{ __('tables.type') }}</span>
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
            if (base_price === 'middle') {
                    name = 'middle';
                    member_price = 'middle';
                    base_price = 'desc'
                } else if (base_price === 'desc') {
                     name = 'middle';
                    member_price = 'middle';
                    base_price = 'asc'
                } else if (base_price === 'asc') {
                     name = 'middle';
                    member_price = 'middle';
                    base_price = 'middle'
                }
                $wire.sortBy('base_price', base_price)">
                <span>{{ __('tables.base_price') }}</span>
                <svg :class="{
                            'rotate-0': base_price === 'desc',
                            '-rotate-180': base_price === 'asc',
                            '-rotate-90': base_price === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2"  @click="
            if (member_price === 'middle') {
                    base_price = 'middle';
                    name = 'middle';
                    member_price = 'desc'
                } else if (member_price === 'desc') {
                     base_price = 'middle';
                    name = 'middle';
                    member_price = 'asc'
                } else if (member_price === 'asc') {
                     base_price = 'middle';
                    name = 'middle';
                    member_price = 'middle'
                }
                $wire.sortBy('member_price', member_price)">
                <span>{{ __('tables.member_price') }}</span>
                <svg :class="{
                            'rotate-0': member_price === 'desc',
                            '-rotate-180': member_price === 'asc',
                            '-rotate-90': member_price === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"></use>
                </svg>
            </button>
        </th>
        <th data-action>{{ __('tables.actions') }}</th>
    </tr>
</thead>
