<?php
class PzkAdminNewsController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = 'news';
	public $addFields = 'title, parent, content,brief';
	public $editFields = 'title, parent, content,brief';
	public $addValidator = array(
		'rules' => array(
			'title' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'title' => array(
				'required' => 'Tên tin t?c không du?c d? tr?ng',
				'minlength' => 'Tên tin t?c ph?i dài 2 kı t? tr? lên',
				'maxlength' => 'Tên tin t?c ch? dài t?i da 255 kı t?'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'title' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'title' => array(
				'required' => 'Tên danh m?c không du?c d? tr?ng',
				'minlength' => 'Tên danh m?c ph?i dài 2 kı t? tr? lên',
				'maxlength' => 'Tên danh m?c ch? dài t?i da 255 kı t?'
			)
		)
	);
	public function addAction() {
		if(pzk_request()->is('POST')) {
				$post = pzk_request()->query;
				
		 $addnews=array(
                    'title'=>$post['title'],
					'brief'=>$post['brief'],
					'content'=>$post['content'],
					'parent'=>$post['parent']);

         $entity = _db()->useCb()->getEntity('table')->setTable('news');
                $entity->setData($addnews);
                $entity->save();
				
		}
				
		$this->initPage();
		$news = pzk_parse(pzk_app()->getPageUri('admin/news/add'));
		$news->setParentId(pzk_request()->getSegment(3));
		
		$this	->append($news)
				->append('admin/news/menu','right')
				->display();
	}
}