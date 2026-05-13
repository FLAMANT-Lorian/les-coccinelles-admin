import flatpickr from "flatpickr";
import {French} from "flatpickr/dist/l10n/fr.js";

function initDateRangePicker() {
    const el = document.querySelector('.date-range-picker');
    flatpickr(el, {
        locale: French,
        mode: "range",
        dateFormat: "Y-m-d",
        disable: JSON.parse(el.dataset.dates),
        altInput: true,
        altFormat: "d F Y",
        allowInput: false,
        minDate: 'today',
    });
}

function initDatePicker() {
    document.querySelectorAll('.date-picker').forEach((el) => {
        flatpickr(el, {
            locale: French,
            dateFormat: "Y-m-d",
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
