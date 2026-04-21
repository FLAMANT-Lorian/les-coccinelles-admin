<?php

namespace App\Enums;

enum YesOrNo: string
{
    case YES = 'yes';
    case NO = 'no';

    public function toBoolean(): bool
    {
        return $this === self::YES;
    }
}
