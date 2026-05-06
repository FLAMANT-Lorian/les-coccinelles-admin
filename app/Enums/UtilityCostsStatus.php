<?php

namespace App\Enums;

enum UtilityCostsStatus: string
{
    case upToDate = 'up_to_date';
    case outOfDate = 'out_of_date';
}
