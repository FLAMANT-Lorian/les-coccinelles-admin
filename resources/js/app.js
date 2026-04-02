import './bootstrap';

import Alpine from 'alpinejs';

if (document.querySelector('.login')) {

    window.Alpine = Alpine;

    Alpine.start();
}
