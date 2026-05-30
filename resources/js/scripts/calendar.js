import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import frLocale from '@fullcalendar/core/locales/fr';
import enLocale from '@fullcalendar/core/locales/en-gb';

function displayCalendar() {
    const calendarElt = document.getElementById('coccinelles-calendar');
    const events = JSON.parse(calendarElt.dataset.events);
    const locale = document.documentElement.lang;

    const calendar = new Calendar(calendarElt, {
        locale: locale === 'fr' ? frLocale : enLocale,
        plugins: [interactionPlugin, dayGridPlugin],
        initialView: window.innerWidth < 768 ? 'dayGridWeek' : 'dayGridMonth',
        height: 'auto',
        events: events,
        displayEventTime: false,
        windowResize: function () {
            if (document.getElementById('coccinelles-calendar')) {
                displayCalendar();
            }
        }
    });
    calendar.render();
}

addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('coccinelles-calendar')) {
        displayCalendar();
    }
});

addEventListener('livewire:navigated', function () {
    if (document.getElementById('coccinelles-calendar')) {
        displayCalendar();
    }
});
