<?php
class PzkAdminCategoryController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = 'categories';
	public $addFields = 'name, parent';
	public $editFields = 'name, parent';
	public function addAction() {
		$this->initPage();
		$category = pzk_parse(pzk_app()->getPageUri('admin/category/add'));
		$category->setParentId(pzk_request()->getSegment(3));
		$this->append($category);
		$this->append('admin/category/menu','right');
		$this->display();
	}
}