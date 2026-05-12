import flatpickr from "flatpickr";
import {French} from "flatpickr/dist/l10n/fr.js";

function initDatePicker() {
    document.querySelectorAll('.date-range').forEach((el) => {
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
    });
}

document.addEventListener('DOMContentLoaded', initDatePicker);
document.addEventListener('livewire:navigated', initDatePicker);
