<?php
class PzkAdminCategoryController extends PzkController {
	public function indexAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/index'));
		pzk_element('left')->append($category);
		$this->appendMenu();
		$page->display();
	}
	public function editAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/edit'));
		$category->setItemId(pzk_request()->getSegment(3));
		pzk_element('left')->append($category);
		$this->appendMenu();
		$page->display();
	}
	public function editPostAction() {
		_db()->useCB()->update('categories')
			->set(array('name' => pzk_request()->get('name')))
			->where(array('id', pzk_request()->get('id')))->result();
		header('Location: /admin_category/index');
	}
	public function addAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/add'));
		$category->setParentId(pzk_request()->getSegment(3));
		pzk_element('left')->append($category);
		$this->appendMenu();
		$page->display();
	}
	public function addPostAction() {
		_db()->useCB()->insert('categories')->fields('name,parent')
			->values(array(array('name' => pzk_request()->get('name'), 
				'parent' => pzk_request()->get('parent'))))
			->result();
		header('Location: /admin_category/index');
	}
	public function delAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/del'));
		$category->setItemId(pzk_request()->getSegment(3));
		pzk_element('left')->append($category);
		$this->appendMenu();
		$page->display();
	}
	public function delPostAction() {
		_db()->useCB()->delete()->from('categories')
			->where(array('id', pzk_request()->get('id')))->result();
		header('Location: /admin_category/index');
	}
	public function appendMenu() {
		pzk_element('right')->append(pzk_parse(pzk_app()->getPageUri('admin/category/menu')));
	}
}