<?php

namespace App\Enums;

enum MessageTypes: string
{
    case contact = 'contact';
    case availability_request = 'availability_request';
}
