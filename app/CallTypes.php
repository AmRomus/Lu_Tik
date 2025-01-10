<?php

namespace App;

enum CallTypes: int
{
    case Info = 0;
    case TV  = 1;
    case Inet  = 2;
    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
     
    }
}