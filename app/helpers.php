<?php

if (!function_exists('formattedDate')) {
    function formattedDate($date)
    {
        return $date->translatedFormat('j F Y');
    }
}

if (!function_exists('enumToArray')) {
    function enumToArray($enum)
    {
        return array_map(function ($enum) {
            return $enum->value;
        }, $enum::cases());
    }
}
