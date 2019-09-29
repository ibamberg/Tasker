<?php

namespace app\core;

use app\core\View;

class Controller {

	private $_controllerName;
	private $_view;

	public function __construct(){
		$this->_controllerName = $this->getControllerName();
		$this->_view = new View;
	}

	public function render($viewName, $vars = []){
		$this->_view->render($this->_controllerName . '/' . $viewName, $vars);
	}

	public function setLayout($layout){
		$this->_view->setLayout($layout);
	}

	private function getControllerName(){
		return strtolower(substr(end(explode("\\", get_called_class())), 0, -10));
	}

}