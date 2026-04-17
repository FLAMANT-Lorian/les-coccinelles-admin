<?php

namespace App\Enums;

enum RoleMode: string
{
    case Unique = 'unique';
    case Multiple = 'multiple';

    public function isSingle(): string
    {
        return $this === self::Unique;
    }
}
