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
	public $masterPosition = 'left';
	public function viewStructure($structure, $useMasterStructure = true) {
		if($useMasterStructure) {
			$page = $this->getStructure($this->masterStructure);
			$request = pzk_element('request');
			if(isset($request->routeData)) {
				$title = $request->routeData['title'];
				$page->title = strip_tags($title);
				$description = @$request->routeData['brief'];
				$page->description = strip_tags($description);
			}
			$obj = $this->getStructure($structure);
			pzk_element($this->masterPosition)->append($obj);
			$page->display();
		} else {
			$obj = $this->getStructure($structure);
			$obj->display();
		}
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
}

?>