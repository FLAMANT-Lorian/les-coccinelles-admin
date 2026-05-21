import flatpickr from "flatpickr";
import {French} from "flatpickr/dist/l10n/fr.js";
import {english as English} from "flatpickr/dist/l10n/default.js";

function initDateRangePicker() {
    const el = document.querySelector('[data-range]');

    document.querySelectorAll('.range input:not([data-range])').forEach(el => el.remove());
    document.querySelectorAll('.flatpickr-calendar.rangeMode').forEach(el => el.remove());

    if (el._flatpickr) {
        el._flatpickr.destroy();
    }

    const locale = document.documentElement.lang;

    flatpickr(el, {
        locale: locale === 'fr' ? French : English,
        mode: "range",
        dateFormat: "Y-m-d",
        disable: JSON.parse(el.dataset.dates),
        altInput: true,
        altFormat: "d F Y",
        allowInput: false,
    });
}

function initDatePicker() {
    document.querySelectorAll('.simple input:not([data-simple])').forEach(el => el.remove());
    document.querySelectorAll('.flatpickr-calendar:not(.rangeMode)').forEach(el => el.remove());

    document.querySelectorAll('[data-simple]').forEach((el) => {
        if (el._flatpickr) {
            el._flatpickr.destroy();
        }

        const locale = document.documentElement.lang;
        flatpickr(el, {
            locale: locale === 'fr' ? French : English,
            altInput: true,
            altFormat: "d F Y",
            allowInput: false,
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.date-range-picker')) {
        initDateRangePicker();
    }
    if (document.querySelector('.date-picker')) {
        initDatePicker();
    }
});

document.addEventListener('livewire:navigated', () => {
    if (document.querySelector('.date-range-picker')) {
        initDateRangePicker();
    }
    if (document.querySelector('.date-picker')) {
        initDatePicker();
    }
});

document.addEventListener('init-date-pickers', () => {
    initDatePicker();
});
