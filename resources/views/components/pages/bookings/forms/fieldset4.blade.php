@php
    $tabs = [
        [
            'label' => __('pages/hall.bookings-create.tab-1'),
            'tab' => 'before-booking'
        ],
        [
            'label' => __('pages/hall.bookings-create.tab-2'),
            'tab' => 'after-booking'
        ],
    ];
@endphp

<fieldset class="col-span-full">
    <legend>{{ __('pages/hall.bookings-create.fieldset-4') }}</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-x-8 gap-y-6"
         x-data="{
            activeTab: 'before-booking',
            setActiveTab(tab) {
                this.activeTab = tab;
            }
        }">
        <div class="col-span-full flex flex-row gap-8 border-b border-b-beige-dark/60 pb-2 overflow-x-auto">
            @foreach ($tabs as $tab)
                <button type="button"
                        @click="setActiveTab('{{ $tab['tab'] }}')"
                        :class="activeTab === '{{ $tab['tab']  }}' ? 'current-tab' : ''"
                        class="tab">
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
        <div
            :class="activeTab === 'before-booking' ? 'block' : 'hidden'"
            class="col-span-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6 trans-all">
            <x-forms.input.input-number
                :label="__('forms.water-general')"
                name="before_water_general"
                min="0"
                field_name="before_water_general"
                wire="form.before_water_general"
            />
            <x-forms.input.input-number
                :label="__('forms.electricity-general')"
                name="before_electricity_general"
                min="0"
                field_name="before_electricity_general"
                wire="form.before_electricity_general"
            />
            <x-forms.input.input-number
                :label="__('forms.mazout-general')"
                name="before_mazout_general"
                min="0"
                field_name="before_mazout_general"
                wire="form.before_mazout_general"
            />
            <x-forms.input.input-number
                :label="__('forms.water-cdj')"
                name="before_water_cdj"
                min="0"
                field_name="before_water_cdj"
                wire="form.before_water_cdj"
            />
            <x-forms.input.input-number
                :label="__('forms.electricity-cdj')"
                name="before_electricity_cdj"
                min="0"
                field_name="before_electricity_cdj"
                wire="form.before_electricity_cdj"
            />
        </div>

        <div
            :class="activeTab === 'after-booking' ? 'block' : 'hidden'"
            class="col-span-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6 trans-all">
            <x-forms.input.input-number
                :label="__('forms.water-general')"
                name="after_water_general"
                min="0"
                field_name="after_water_general"
                wire="form.after_water_general"
            />
            <x-forms.input.input-number
                :label="__('forms.electricity-general')"
                name="after_electricity_general"
                min="0"
                field_name="after_electricity_general"
                wire="form.after_electricity_general"
            />
            <x-forms.input.input-number
                :label="__('forms.mazout-general')"
                name="after_mazout_general"
                min="0"
                field_name="after_mazout_general"
                wire="form.after_mazout_general"
            />
            <x-forms.input.input-number
                :label="__('forms.water-cdj')"
                name="after_water_cdj"
                min="0"
                field_name="after_water_cdj"
                wire="form.after_water_cdj"
            />
            <x-forms.input.input-number
                :label="__('forms.electricity-cdj')"
                name="after_electricity_cdj"
                min="0"
                field_name="after_electricity_cdj"
                wire="form.after_electricity_cdj"
            />
        </div>
    </div>
</fieldset>
