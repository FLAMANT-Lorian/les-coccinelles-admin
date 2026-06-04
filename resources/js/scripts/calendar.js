import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import frLocale from '@fullcalendar/core/locales/fr';
import enLocale from '@fullcalendar/core/locales/en-gb';

let calendar;
let allEvents = [];

function displayCalendar() {
    const calendarElt = document.getElementById('coccinelles-calendar');
    const locale = document.documentElement.lang;

    allEvents = JSON.parse(calendarElt.dataset.events);

    calendar = new Calendar(calendarElt, {
        locale: locale === 'fr' ? frLocale : enLocale,
        plugins: [interactionPlugin, dayGridPlugin],
        initialView: window.innerWidth < 768 ? 'dayGridWeek' : 'dayGridMonth',
        height: 'auto',
        events: allEvents,
        displayEventTime: false,
        windowResize: function () {
            if (document.getElementById('coccinelles-calendar')) {
                displayCalendar();
            }
        }
    });
    calendar.render();
}

function filterEvents(filters) {
    if (!calendar) return;
    calendar.removeAllEvents();
    const newEvents = allEvents.filter(e => filters.includes(e.type))
    calendar.addEventSource(newEvents);
}

addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('coccinelles-calendar')) {
        displayCalendar();
        handleFilters();
    }
});

addEventListener('livewire:navigated', function () {
    if (document.getElementById('coccinelles-calendar')) {
        displayCalendar();
        handleFilters();
    }
});

let activeFilters = ['bookings', 'meetings', 'events', 'interventions'];

function handleFilters() {
    document.querySelectorAll('[data-type]').forEach(btn => {
        btn.addEventListener('click', e => {
            const btn = e.currentTarget;
            const type = btn.dataset.type;

            if (activeFilters.includes(type)) {
                activeFilters = activeFilters.filter(el => el !== type);
                btn.style.opacity = '0.25';
            } else {
                activeFilters.push(type);
                btn.style.opacity = '1';
            }

            filterEvents(activeFilters);
        });
    });
}
