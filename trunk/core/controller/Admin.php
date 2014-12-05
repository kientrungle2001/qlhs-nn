<?php
class PzkAdminController extends PzkController {
	public $table = false;
	public function __construct() {
		$controller = pzk_request('controller');
		$contrParts = explode('_', $controller);
		$this->module = $contrParts[1];
		if(!$this->table) {
			$this->table = $this->module;
		}
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
	public function addPostAction() {
		$row = $this->getAddData();
		$this->add($row);
		$this->redirect('index');
	}
	public function getAddData() {
		$row = array();
		$fields = explode(',', $this->addFields);
		foreach($fields as $field) {
			$field = trim($field);
			$row[$field] = pzk_request($field);
		}
		return $row;
	}
	public function add($row) {
		$entity = _db()->getEntity('table')->setTable($this->table);
		$entity->setData($row);
		$entity->save();
		pzk_notifier()->addMessage('Thêm thành công');
	}
	public function editPostAction() {
		$row = $this->getEditData();
		$this->edit($row);
		$this->redirect('index');
	}
	public function getEditData() {
		$row = array();
		$fields = explode(',', $this->editFields);
		foreach($fields as $field) {
			$field = trim($field);
			$row[$field] = pzk_request($field);
		}
		return $row;
	}
	public function edit($row) {
		$entity = _db()->getEntity('table')->setTable($this->table);
		$entity->load(pzk_request('id'));
		$entity->update($row);
		$entity->save();
		pzk_notifier()->addMessage('Cập nhật thành công');
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
		_db()->useCB()->delete()->from($this->table)
			->where(array('id', pzk_request()->get('id')))->result();
		$this->redirect($index);
	}
}