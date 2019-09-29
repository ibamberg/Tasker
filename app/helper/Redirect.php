<?php

namespace app\helper;


class Redirect
{
	
	public static function goHome(){
		self::to('/');
	}


	public static function to($location) {
        if ($location) {
            header("Location: " . $location);
            exit();
        } 
    }
	
}