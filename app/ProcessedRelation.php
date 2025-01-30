<?php

namespace App;

enum ProcessedRelation: int
{
    case Fake = 0;
    case Config  = 1;
    case Cable  = 2;
    case Device  = 3;
    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
     
    }
}
