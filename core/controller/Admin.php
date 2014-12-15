<?php
class PzkAdminController extends PzkController {
	public $table = false;
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public function __construct() {
		$controller = pzk_request('controller');
		$contrParts = explode('_', $controller);
		$this->module = $contrParts[1];
		if(!$this->table) {
			$this->table = $this->module;
		}
	}
	public function changeStatusAction() {
		$id = pzk_request()->getSegment(3);
		$entity = _db()->getTableEntity($this->table);
		$entity->load($id);
		$status = 1 - $entity->getStatus();
		$entity->update(array('status' => $status));
		$this->redirect('index');
	}
	public function changeOrderByAction() {
		pzk_session($this->table.'OrderBy', pzk_request('orderBy'));
		$this->redirect('index');
	}
	public function changeCategoryIdAction() {
		pzk_session($this->table.'CategoryId', pzk_request('categoryId'));
		$this->redirect('index');
	}
	public function changeTypeAction() {
		pzk_session($this->table.'Type', pzk_request('type'));
		$this->redirect('index');
	}
	public function changePageSizeAction() {
		pzk_session($this->table.'PageSize', pzk_request('pageSize'));
		$this->redirect('index');
	}
	public function searchPostAction() {
		pzk_session($this->table.'Keyword', pzk_request('keyword'));
		$this->redirect('index');
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
		if($this->validateAddData($row)) {
			$this->add($row);
			pzk_notifier()->addMessage('Thêm thành công');
			$this->redirect('index');
		} else {
			pzk_validator()->setEditingData($row);
			$this->redirect('add');
		}
	}
	public function getAddData() {
		return pzk_request()->getFilterData($this->addFields);
	}
	public function validateAddData($row) {
		return $this->validate($row, @$this->addValidator);
	}
	public function add($row) {
		$entity = _db()->getEntity('table')->setTable($this->table);
		$entity->setData($row);
		$entity->save();
	}
	public function editPostAction() {
		$row = $this->getEditData();
		if($this->validateEditData($row)) {
			$this->edit($row);
			pzk_notifier()->addMessage('Cập nhật thành công');
			$this->redirect('index');
		} else {
			pzk_validator()->setEditingData($row);
			$this->redirect('edit/' . pzk_request('id'));
		}
	}
	public function getEditData() {
		return pzk_request()->getFilterData($this->editFields);
	}
	public function validateEditData($row) {
		return $this->validate($row, @$this->editValidator);
	}
	public function edit($row) {
		$entity = _db()->getEntity('table')->setTable($this->table);
		$entity->load(pzk_request('id'));
		$entity->update($row);
		$entity->save();
	}
	public function editAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/'.$this->module.'/edit'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/'.$this->module.'/menu', 'right')
			->display();
	}
	public function detailAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/'.$this->module.'/detail'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/'.$this->module.'/menu', 'right');
		if($childList = pzk_element($this->module.'Children')){
			$childList->setParentId(pzk_request()->getSegment(3));
		}
		$this->display();
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
		pzk_notifier()->addMessage('Xóa thành công');
		$this->redirect('index');
	}
}