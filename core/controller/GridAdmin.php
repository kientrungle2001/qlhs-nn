<?php
class PzkGridAdminController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = false;
	public $listFieldSettings = array();
	public $addLabel = 'Thêm bản ghi';
	public $addFieldSettings = array();
	public $editFieldSettings = array();
	public $searchFields = array();
	public $filterFieldSettings = array();
	public $sortFields = array();
	public function append($obj, $position = NULL) {
		$obj = $this->parse($obj);
		$obj->setTable($this->table);
		return parent::append($obj, $position);
	}
	public function indexAction() {
		$this->initPage()
			->append('admin/grid/index')
			->append('admin/grid/menu', 'right')
			->display();
	}
	public function addAction() {
		$this->initPage()
			->append('admin/grid/add')
			->append('admin/grid/menu', 'right')
			->display();
	}
	public function editAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/grid/edit'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/grid/menu', 'right')
			->display();
	}
	public function detailAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/grid/detail'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/grid/menu', 'right');
		if($childList = pzk_element($this->module.'Children')){
			$childList->setParentId(pzk_request()->getSegment(3));
		}
		$this->display();
	}
	public function delAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/grid/del'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
			->append($module)
			->append('admin/grid/menu', 'right')
			->display();
	}
}