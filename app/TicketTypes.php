<?php

namespace App;

enum TicketTypes:int
{  
    case Install = 0;
    case Support  = 1;
    case Uninstall  = 2;
    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
     
    }

}
