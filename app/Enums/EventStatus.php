<?php

namespace App\Enums;

enum EventStatus: string
{
    case NOW = 'now';
    case PAST = 'past';
    case SOON = 'soon';
}
