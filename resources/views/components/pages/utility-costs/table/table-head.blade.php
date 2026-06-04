<thead>
    <tr x-data="{ type: 'middle', price: 'middle',}">
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (type === 'middle') {
                    price = 'middle';
                    type = 'desc'
                } else if (type === 'desc') {
                    price = 'middle';
                    type = 'asc'
                } else if (type === 'asc') {
                    price = 'middle';
                    type = 'middle'
                }
                $wire.sortBy('type', type)">
                <span>{{ __('tables.type') }}</span>
                <svg :class="{
                            'rotate-0': type === 'desc',
                            '-rotate-180': type === 'asc',
                            '-rotate-90': type === 'middle'
                         }"
                     class="trans-all" width="11" height="16" viewBox="0 0 11 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <use href="#th-filter-arrow"/>
                </svg>
            </button>
        </th>
        <th>
            <button type="button" class="flex items-center gap-2" @click="
            if (price === 'middle') {
                    type = 'middle';
                    price = 'desc'
                } else if (price === 'desc') {
                     type = 'middle';
                    price = 'asc'
                } else if (price === 'asc') {
                     type = 'middle';
                    price = 'middle'
                }
                $wire.sortBy('price', price)">
                <span>{{ __('tables.base_price') }}</span>
                <svg :class="{
                            'rotate-0': price === 'desc',
                            '-rotate-180': price === 'asc',
                            '-rotate-90': price === 'middle'
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
