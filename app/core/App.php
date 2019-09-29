<?php

namespace app\core;

use Exception;
use app\models\User;

class App{

	private $_controller = 'Task';
	private $_action = 'actionIndex';
	private $_params = [];

	public static $user = null;

	public function __construct(){

		$this->_params = explode('/', filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));

		foreach ($this->_params as $key => $value) {
			$param = stristr($value, '?', true);
			if($param) $this->_params[$key] = $param;
		}

		try{
			$this->_getController();
			$this->_getAction();
			$this->_getParams();
		} catch (Exception $ex) {
			//TODO go to 404 page
			header('HTTP/1.0 404 Not Found');
			exit();
		}

	} 

	private function _getController(){
		if (isset($this->_params[0]) and ! empty($this->_params[0])) {
            $this->_controller = ucfirst($this->_params[0]);
            unset($this->_params[0]);
        }

		$this->_controller = "app\controllers\\" . $this->_controller . 'Controller';

        if (!class_exists($this->_controller)) {
            throw new Exception("Controller {$this->_controller} does not exist!");
        }

        $this->_controller = new $this->_controller;
	}

	private function _getAction(){
		$secondParam = $this->_params[1];
		if (isset($secondParam) and !empty($secondParam)) {
			$secondParam = 'action' . ucfirst($secondParam);
			if(method_exists($this->_controller, $secondParam)){
				$this->_action = $secondParam;
				unset($this->_params[1]);
			}
        }

        if(!method_exists($this->_controller, $this->_action)){
        	throw new Exception("{$this->_action} does not exist!");
        }
	}

	 private function _getParams() {
        $this->_params = $this->_params ? array_values($this->_params) : [];
    }

	public function run(){
		self::$user = new User;
		call_user_func_array([$this->_controller, $this->_action], $this->_params);	
	}
}