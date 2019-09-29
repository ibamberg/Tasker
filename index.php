<?php

if (session_id() == "") session_start();

spl_autoload_register(function($class) {
	$path = str_replace('\\', '/', $class . '.php');
	if(file_exists($path)){
		require $path;
	}
});

$app = new app\core\App;
$app->run();