<?php
class PzkAdminNewsController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = 'news';
	public $addFields = 'title, parent, content,brief';
	public $editFields = 'title, parent, content,brief';
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
				'required' => 'Tên danh m?c không du?c d? tr?ng',
				'minlength' => 'Tên danh m?c ph?i dài 2 kı t? tr? lên',
				'maxlength' => 'Tên danh m?c ch? dài t?i da 255 kı t?'
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
				'required' => 'Tên danh m?c không du?c d? tr?ng',
				'minlength' => 'Tên danh m?c ph?i dài 2 kı t? tr? lên',
				'maxlength' => 'Tên danh m?c ch? dài t?i da 255 kı t?'
			)
		)
	);
	public function addAction() {
		$this->initPage();
		
		$news = pzk_parse(pzk_app()->getPageUri('admin/news/add'));
		$news->setParentId(pzk_request()->getSegment(3));
		
		$this	->append($news)
				->append('admin/news/menu','right')
				->display();
	}
}