import {Fancybox} from "@fancyapps/ui/dist/fancybox/";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

addEventListener('DOMContentLoaded', function () {
    Fancybox.bind('[data-fancybox]');
});

addEventListener('init-fancybox', function () {
    Fancybox.bind('[data-fancybox]');
});
