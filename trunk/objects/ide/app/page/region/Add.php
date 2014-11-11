<?php
class PzkIdeAppPageRegionAdd extends PzkObject {
	public $layout = 'ide/app/page/region/add';
	public $_template = false;
	public $_page = false;
	public $_app = false;
	public $parentId = false;
	public function getTemplate() {
		if($this->_template) return $this->_template;
		$app = $this->getApp();
		if(isset($app['templateId'])) {
			$this->_template = _db()->select('*')->from('resource')->where('id=' . $app['templateId'])->result_one();
			return $this->_template;
		}
	}
	
	public function getApp() {
		if($this->_app) return $this->_app;
		$page = $this->getPage();
		$this->_app = _db()->select('*')->from('profile_resource')->where('id='. $page['parentId'])->result_one();
		return $this->_app;
	}
	
	public function getPage() {
		if($this->_page) return $this->_page;
		$this->_page = _db()->select('*')->from('profile_resource')->where('id='. $this->parentId)->result_one();
		return $this->_page;
	}
}