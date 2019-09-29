<?php

namespace app\helper;

class Input
{
	
	public static function isSubmit(){
		if(self::get('submit') === '' || self::post('submit') === '')
			return true;
		else
			return false;
	}

	public static function get($key){
		if(isset($_GET[$key]))
			return self::filter($_GET[$key]);

	}

	public static function post($key){
		if(isset($_POST[$key]))
			return self::filter($_POST[$key]);

	}

	public static function filter($data) {
	    if (is_array($data)) {
	        foreach ($data as $key => $element) {
	            $data[$key] = filter($element);
	        }
	    } else {
	        $data = trim(htmlentities(strip_tags($data)));
	        if(get_magic_quotes_gpc()) $data = stripslashes($data);
	    }
	    return $data;
	}
	
}