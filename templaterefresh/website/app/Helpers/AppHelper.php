<?php

namespace App\Helpers;

class AppHelper 
{
	public static function ObjectToArray(Object $object) {
		if (gettype($object) === 'object') {
			$encoded = json_encode($object);
			$toArray = json_decode($encoded, true);

			return $toArray;
		}

		return $object;
	}

	public static function ArrayToObject(Array $array) {
		if (gettype($array) === 'array') {
			$encoded = json_encode($array);
			$toObject = json_decode($encoded);

			return $toObject;
		}

		return $array;
	}
}
