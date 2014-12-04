<?php
class PzkAdminCategoryController extends PzkController {
	public function indexAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/index'));
		pzk_element('left')->append($category);
		$page->display();
	}
	public function editAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/edit'));
		$category->setItemId(pzk_request()->getSegment(3));
		pzk_element('left')->append($category);
		$page->display();
	}
	public function addAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/add'));
		pzk_element('left')->append($category);
		$page->display();
	}
	public function delAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/del'));
		pzk_element('left')->append($category);
		$page->display();
	}
}