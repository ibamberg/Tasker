<?php

namespace app\helper;

class Config
{
	public static function get(){
		return [
			'db' => [
				'dsn' => 'mysql:host=localhost;dbname=tasker',
				'username' => 'root',
		        'password' => '',
			],
		];
	}
}