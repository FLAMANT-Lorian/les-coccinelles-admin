<?php

$tabs = [
    [
        'label' => __('pages/members.members'),
        'location' => route('members.index', ['locale' => app()->getLocale()]),
        'permission' => 'members.index'
    ],
    [
        'label' => __('pages/roles.role'),
        'location' => route('roles.index', ['locale' => app()->getLocale()]),
        'permission' => 'roles.index'
    ]
];

?>

<x-general.tabs
    :tabs="$tabs"/>
