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

/* SOURCE : https://www.geeksforgeeks.org/php/php-program-to-convert-title-to-url-slug/ */
if (!function_exists('slugify')) {

    function slugify(string $str): string
    {
        // Convert string to lowercase
        $str = strtolower($str);

        // Replace the spaces with hyphens
        $str = str_replace(' ', '-', $str);

        // Remove the special characters
        $str = preg_replace('/[^a-z0-9\-]/', '', $str);

        // Remove the consecutive hyphens
        $str = preg_replace('/-+/', '-', $str);

        // Trim hyphens from the beginning
        // and ending of String
        return trim($str, '-');
    }
}
