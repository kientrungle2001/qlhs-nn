<?php
class PzkGridAdminController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $customModule = 'grid';
	public $table = false;
    public $joins = false;
    public $selectFields = '*';
    public $childTable = false;
    public $setAddTabs = false;
    public $setEditTabs = false;
    public $filterFields = false;
    public $menuLinks = false;
	public $listFieldSettings = array();
	public $addLabel = 'Thêm bản ghi';
	public $addFieldSettings = array();
	public $editFieldSettings = array();
	public $searchFields = array();
	public $filterFieldSettings = array();
	public $sortFields = array();
	public $events = array(
		'index.after' => array('this.indexAfter')
	);
	public function append($obj, $position = NULL) {
		$obj = $this->parse($obj);
		$obj->setTable($this->table);
		return parent::append($obj, $position);
	}
	public function indexAfter($event, $data) {
		$list = pzk_element('list');
		if($list) {
			$list->addEventListener('changeStatus', 'onChangeStatus');
		}
	}
	
	public function onChangeStatusAction() {
		$id = pzk_request('id');
		$entity = _db()->getTableEntity($this->table)->load($id);
		$status = 1 - $entity->getStatus();
		$entity->update(array('status' => $status));
		if($entity->getStatus() == '1') {
			//jQuery('#status-' . $id)->html('Hoạt động')->display();
		} else {
			//jQuery('#status-' . $id)->html('Không hoạt động')->display();
		}
	}
}