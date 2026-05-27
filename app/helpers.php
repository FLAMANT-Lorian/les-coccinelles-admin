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

if (!function_exists('getCorrectRoute')) {
    function getCorrectRoute(array $hallRoutes): ?string
    {
        foreach ($hallRoutes as $hallRoute) {
            if (auth()->user()->can($hallRoute['permission'])) {
                return route($hallRoute['route']);
            }
        }
        return null;
    }
}
