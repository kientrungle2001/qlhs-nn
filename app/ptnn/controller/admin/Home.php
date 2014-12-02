<?php
class PzkAdminHomeController extends PzkController {
	public function indexAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$page->display();
	}
	public function categoryJSON() {
		$items = _db()->select('*')->from('categories')->result();
		$str = json_encode($items, true);
		echo $str;
	}
	public function categoryAction() {
		$request = pzk_request();
		
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		
		$categoryId = $request->getSegment(3);
		$categoryUri = pzk_app()->getPageUri('admin/home/category');
		pzk_parse($categoryUri);
		$category = pzk_element('category');
		$category->setRootId($categoryId);
		pzk_element('right')->append($category);
		
		$questionsUri = pzk_app()->getPageUri('admin/home/questions');
		$questions = pzk_parse($questionsUri);
		$questions->setParentId($categoryId);
		pzk_element('left')->append($questions);
		$page->display();
	}
}