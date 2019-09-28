<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class ArrayTypes extends Enum {

	private const SEQUENTIAL = "sequential";
	private const ASSOCIATIVE = "associative";

	/**
     * @return ArrayType
     */
    public static function SEQUENTIAL() {
		$v = new ArrayTypes(self::SEQUENTIAL);
		return $v->getValue();
	}
	
	public static function ASSOCIATIVE() {
		$v = new ArrayTypes(self::ASSOCIATIVE);
		return $v->getValue();
    }
}