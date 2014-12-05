<?php
class PzkAdminCategoryController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	
	public function editPostAction() {
		_db()->useCB()->update('categories')
			->set(array('name' => pzk_request()->get('name')))
			->where(array('id', pzk_request()->get('id')))->result();
		$this->redirect('index');
	}
	public function addAction() {
		$this->initPage();
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/add'));
		$category->setParentId(pzk_request()->getSegment(3));
		$this->append($category);
		$this->append('admin/category/menu','right');
		$this->display();
	}
	public function addPostAction() {
		_db()->useCB()->insert('categories')->fields('name,parent')
			->values(array(array('name' => pzk_request()->get('name'), 
				'parent' => pzk_request()->get('parent'))))
			->result();
		$this->redirect('index');
	}
	public function delPostAction() {
		_db()->useCB()->delete()->from('categories')
			->where(array('id', pzk_request()->get('id')))->result();
		$this->redirect('index');
	}
}