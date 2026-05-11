<?php

namespace App\Enums;

enum BookingStatus: string
{
    case NOW = 'now';
    case PAST = 'past';
    case SOON = 'soon';
}
