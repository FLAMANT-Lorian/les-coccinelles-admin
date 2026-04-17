<?php

namespace App\Enums;

enum MembersStatus: string
{
    case active = 'active';
    case pause = 'pause';
    case inactive = 'inactive';
}
