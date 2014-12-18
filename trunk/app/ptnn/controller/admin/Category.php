<?php
class PzkAdminCategoryController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = 'categories';
	public $addFields = 'name, parent, router';
	public $editFields = 'name, parent, router';
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên danh mục không được để trống',
				'minlength' => 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên danh mục không được để trống',
				'minlength' => 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public function addAction() {
		$this->initPage();
		
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/add'));
		$category->setParentId(pzk_request()->getSegment(3));
		
		$this	->append($category)
				->append('admin/category/menu','right')
				->display();
	}
	
	public function indexAction() {
		$this->initPage()
		->append('admin/'.$this->module.'/index')
		->append('admin/'.$this->module.'/menu', 'right');
		$list = pzk_element('list');
		$list->addEventListener('changeStatus', 'onChangeStatus');
		$this->display();
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