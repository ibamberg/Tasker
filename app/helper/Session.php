<?php

namespace app\helper;

class Session
{
		
	public static function init(){
		if (session_id() == "") session_start();
	}

	public static function exists($key) {
		if (session_id() == "") session_start();
        return(isset($_SESSION[$key]));
    }

    public static function delete($key){
    	if(self::exists($key)) 
    		unset($_SESSION[$key]);
    }

    public static function get($key){
    	if(self::exists($key)) 
    		return $_SESSION[$key];
    }

    public static function set($key, $value){
    	return($_SESSION[$key] = $value);
    }

    public static function destroy() {
        session_destroy();
    }
}