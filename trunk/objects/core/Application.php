<?php

class PzkCoreApplication extends PzkObjectLightWeight {

    public $name = false;
    public $libraries = array();
    public $dispatcher = 'ElementBased';
	
	public function run() {
		$request = pzk_element('request');
		$controller = pzk_or(@$request->query['controller'], 'Home');
		$action = pzk_or(@$request->query['action'], 'index');
		$controllerObject = $this->getController($controller);
		if(!$controllerObject) die('No controller ' .$controller);
		$controllerObject->setApp($this);
		$this->controller = $controllerObject;
		if(method_exists($controllerObject, $action . 'Action'))
			$controllerObject->{$action . 'Action'}();
		else {
			die('No route ' . $action);
		}
	}
	
	public function getController($controller) {
		$parts = explode('_', $controller);
		$parts[count($parts)-1] = str_ucfirst($parts[count($parts)-1]);
		$fileName = $this->getUri('controller/' . implode('/', $parts) . '.php');
		if(!file_exists($fileName)) {
			$fileName = 'controller/' . implode('/', $parts) . '.php';
			if(!file_exists($fileName))
				return null;
		}
		require_once $fileName;
		$controllerClass = PzkParser::getClass( $parts ) . 'Controller';
		return new $controllerClass();
	}

    public function getUri($path) {
        return 'app/' . $this->name . '/' . $path;
    }

    public function getLayoutUri($path) {
        return $this->getUri('layout/' . $path);
    }

    public function getPageUri($page) {
		$page = preg_replace('/^\//', '', $page);
        return $this->getUri('pages/' . $page);
    }

    public function getIncludeUri($include) {
        return $this->getPageUri('include/' . $include);
    }

    public function getComponentUri($comp, $mode) {
        return $this->getPageUri('components/' . $comp . '/' . $mode);
    }

    public function getTemplateUri($path) {
        if (@$this->template) {
            return $this->getUri('templates/' . $this->template . '/' . $path);
        }

        return $this->getUri('templates/' . $path);
    }

    public function getTemplateImageUri($path) {
        return $this->getTemplateUri('images/' . $path);
    }

}

?>