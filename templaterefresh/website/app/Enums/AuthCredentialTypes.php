<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class AuthCredentialTypes extends Enum {

	private const REGISTER = "register";
	private const LOGIN = "login";

	/**
     * @return AuthCredentialTypes
     */
    public static function LOGIN() {
		$v = new AuthCredentialTypes(self::LOGIN);
		return $v->getValue();
	}
	
	public static function REGISTER() {
		$v = new AuthCredentialTypes(self::REGISTER);
		return $v->getValue();
    }
}