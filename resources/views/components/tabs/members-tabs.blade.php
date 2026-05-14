<?php

use App\Models\Role;
use App\Models\User;

$tabs = [
    [
        'label' => __('pages/members.members'),
        'location' => LaravelLocalization::localizeURL(route('members.index')),
        'model' => User::class

    ],
    [
        'label' => __('pages/roles.role'),
        'location' => LaravelLocalization::localizeURL(route('roles.index')),
        'model' => Role::class
    ]
];

?>

<x-general.tabs
    :tabs="$tabs"/>
