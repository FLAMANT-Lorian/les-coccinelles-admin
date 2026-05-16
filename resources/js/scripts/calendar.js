import {Calendar} from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

function displayCalendar() {
    const calendarElt = document.getElementById('coccinelles-calendar');
    const calendar = new Calendar(calendarElt, {
        plugins: [interactionPlugin, dayGridPlugin],
        initialView: 'dayGridMonth',
    });
    calendar.render();
}

addEventListener('DOMContentLoaded', function () {
    displayCalendar();
});

addEventListener('livewire:navigated', function () {
    displayCalendar();
});
