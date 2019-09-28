<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class AuthRequestTypes extends Enum
{
    private const REFRESH_TOKEN = "refresh_token";
    private const PASSWORD = "password";
    private const CLIENT_CREDENTIALS = "client_credentials";

    /**
     * @return AuthRequestTypes
     */
    public static function REFRESH_TOKEN()
    {
        $v = new AuthRequestTypes(self::REFRESH_TOKEN);
        return $v->getValue();
    }
    
    public static function PASSWORD()
    {
        $v = new AuthRequestTypes(self::PASSWORD);
        return $v->getValue();
    }

     public static function CLIENT_CREDENTIALS()
    {
        $v = new AuthRequestTypes(self::CLIENT_CREDENTIALS);
        return $v->getValue();
    }



}
