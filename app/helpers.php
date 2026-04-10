<?php

if (!function_exists('formattedDate')) {
    function formattedDate($date)
    {
        return $date->translatedFormat('j F Y');
    }
}
