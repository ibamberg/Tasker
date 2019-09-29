<?php

namespace app\helper;

use app\helper\Session;

class Flash
{
	
	public static $types = ['primary', 'success', 'danger'];

	public static function set($type, $message){
		if(in_array($type, self::$types)){
			Session::set('flash', ['type' => $type, 'message' => $message]);
		}
	}

	public static function get(){
		if($flash = Session::get('flash')){
			$alert = "<div class='alert alert-{$flash['type']} alert-dismissible fade show' role='alert'>
						<strong></strong>{$flash['message']}
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>";

			Session::delete('flash');
			return $alert;
		}
	}
}