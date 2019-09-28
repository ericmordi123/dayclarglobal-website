<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class ResponseTypes extends Enum
{
    private const VALIDATION = "validation";
    private const WARNING = "warning";
    private const GENERIC = "generic";
    private const INTERNAL = "internal";

    /**
     * @return ResponseTypes
     */
    public static function VALIDATION()
    {
        $v = new ResponseTypes(self::VALIDATION);
        return $v->getValue();
    }
    
    public static function WARNING()
    {
        $v = new ResponseTypes(self::WARNING);
        return $v->getValue();
    }

      public static function GENERIC()
    {
        $v = new ResponseTypes(self::GENERIC);
        return $v->getValue();
    }

     public static function INTERNAL()
    {
        $v = new ResponseTypes(self::INTERNAL);
        return $v->getValue();
    }

}
