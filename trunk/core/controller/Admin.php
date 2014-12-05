<?php
class PzkAdminController extends PzkController {
	public function __construct() {
		$controller = pzk_request('controller');
		$contrParts = explode('_', $controller);
		$this->module = $contrParts[1];
	}
	public function indexAction() {
		$this->initPage()
			->append('admin/'.$this->module.'/index')
			->append('admin/'.$this->module.'/menu', 'right')
			->display();
	}
	public function addAction() {
		$this->initPage()
			->append('admin/'.$this->module.'/add')
			->append('admin/'.$this->module.'/menu', 'right')
			->display();
	}
	public function editAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/'.$this->module.'/edit'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/user/menu', 'right')
			->display();
	}
	
	public function delAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/'.$this->module.'/del'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/'.$this->module.'/menu', 'right')
			->display();
	}
	
	public function delPostAction() {
		_db()->useCB()->delete()->from($this->module)
			->where(array('id', pzk_request()->get('id')))->result();
		$this->redirect($index);
	}
	public function redirect($action) {
		pzk_request()->redirect(pzk_request()->buildAction($action));
	}
}