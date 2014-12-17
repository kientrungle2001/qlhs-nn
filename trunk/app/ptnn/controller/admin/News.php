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
				'required' => 'T�n danh m?c kh�ng du?c d? tr?ng',
				'minlength' => 'T�n danh m?c ph?i d�i 2 k� t? tr? l�n',
				'maxlength' => 'T�n danh m?c ch? d�i t?i da 255 k� t?'
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
				'required' => 'T�n danh m?c kh�ng du?c d? tr?ng',
				'minlength' => 'T�n danh m?c ph?i d�i 2 k� t? tr? l�n',
				'maxlength' => 'T�n danh m?c ch? d�i t?i da 255 k� t?'
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