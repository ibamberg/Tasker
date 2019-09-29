<?php

namespace app\core;

class View {
	private $_layout = 'default';

	public function render($view, $vars = []){
		extract($vars);
		$content = $this->getView($view, $vars);
		require 'app/views/layouts/' . $this->_layout . '.php';
	}

	public function setLayout($layout){
		$layoutPath = "app/views/layouts/" . $layout . ".php";
		if(file_exists($layoutPath)) $this->$_layout = $layout;
	}

	private function getView($viewName, $vars = []){
		extract($vars);
		$path = 'app/views/' . $viewName . '.php';

		if(file_exists($path)){
			ob_start();
			require $path;
			return ob_get_clean();
		}else{
			//throw new Exception("view {$path} does not exits");
		}
	}

}