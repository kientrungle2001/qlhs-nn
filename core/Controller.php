<?php

class PzkController {

    /**
     *
     * @var PzkCoreApplication
     */
    public $app;

    /**
     * 
     * @param PzkCoreApplication $app
     */
    public function setApp(PzkCoreApplication $app) {
        $this->app = $app;
    }

    /**
     * 
     * @return PzkCoreApplication
     */
    public function getApp() {
        return $this->app;
    }
	
	public function getStructure($uri) {
		if($uri instanceof PzkObject) return $uri;
		if(strpos($uri, '<') !==false) return pzk_parse($uri);
		return pzk_parse($this->getApp()->getPageUri($uri));
	}
	
	public $masterStructure = 'masterStructure';
	public $masterPage = false;
	public $masterPosition = 'left';
	public function viewStructure($structure, $useMasterStructure = true, $display = true) {
		if($useMasterStructure) {
			$page = $this->getStructure(pzk_or($this->masterPage, $this->masterStructure));
			$request = pzk_element('request');
			if(isset($request->routeData)) {
				$title = $request->routeData['title'];
				$page->title = strip_tags($title);
				$description = @$request->routeData['brief'];
				$page->description = strip_tags($description);
			}
			$obj = $this->getStructure($structure);
			pzk_element($this->masterPosition)->append($obj);
			if($display)
				$page->display();
			else return $page;
		} else {
			$obj = $this->getStructure($structure);
			if($display)
				$obj->display();
			else
				return $obj;
		}
	}
	
	public function buildPage($page /*object*/) {
		return $this->viewStructure($page, true, false);
	}
	
	public function viewGrid($grid, $useMasterStructure = true) {
		$this->viewStructure('grid/' . $grid, $useMasterStructure);
	}
	
	public function viewOperation($op, $useMasterStructure = true) {
		$this->viewStructure('operation/' . $op, $useMasterStructure);
	}
	
	public function getOperationStructure($op) {
		return $this->getStructure('operation/' . $op);
	}
	
	public function getModel($model) {
		return pzk_loader()->getModel($model);
	}
	
	public function initPage() {
		$page = $this->getStructure(pzk_or($this->masterPage, $this->masterStructure));
		$this->page = $page;
		return $this;
	}
	
	public function append($obj, $position = NULL) {
		$obj = $this->getStructure($obj);
		if($position){
			pzk_element($position)->append($obj);
		} else {
			pzk_element($this->masterPosition)->append($obj);
		}
		return $this;
	}
	
	public function display() {
		$this->page->display();
		return $this;
	}
	
	public function redirect($action) {
		pzk_request()->redirect(pzk_request()->buildAction($action));
	}
	
	public function validate($row, $validator) {
		if(isset($validator) && $validator) {
			$result = pzk_validate($row, $validator);
			if($result !== true) {
				foreach($result as $field => $messages) {
					foreach($messages as $message) {
						pzk_notifier()->addMessage($message, 'warning');
					}
				}
				return false;
			}
		}
		return true;
	}
}

?>