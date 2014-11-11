<?php
class PzkCoreLoader extends PzkObjectLightWeight{
	public $models;
	public $controllers;

	public function init() {
		$this->models = array();
		$this->controllers = array();
	}

	public function getModel($model){
		if (!isset($this->models[$model])) {
			$this->models[$model] = $this->createModel($model);
		}
		return $this->models[$model];
	}

	public function getController($controller) {
		if (!$controller) return false;
		if (!isset($this->controllers[$controller])) {
			$this->controllers[$controller] = $this->createController($controller);
		}
		return $this->controllers[$controller];
	}

	public function createController($controller) {
		require_once _element('system')->path("controllers/$controller.php");
		$className = PzkParser::getClass($controller. 'Controller');
		if (class_exists($className)) return new $className();
		return false;
	}

	public function createModel($model) {
		$names = explode('.', $model);
		$fullNames = array_merge(array(), $names);

		$name = array_pop($names);
		$package = implode('/', $names);

		$className = PzkParser::getClass($fullNames).'Model';

		if (!class_exists($className)) {
			if(file_exists(BASE_DIR . '/model/' . $package . '/' . str_ucfirst($name) . '.php')) 
				require_once BASE_DIR . '/model/' . $package . '/' . str_ucfirst($name) . '.php';
			else
				return null;
		}
		if(class_exists($className))
			return new $className();
		return null;
	}
	
	public function importObject($uri) {
		require_once BASE_DIR . '/objects/' . $uri . '.php';
	}

}
?>