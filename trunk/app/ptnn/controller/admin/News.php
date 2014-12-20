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
				'required' => 'Tên tin tức không được để trống',
				'minlength' => 'Tên tin tức phải từ hai ký tự trở lên',
				'maxlength' => 'Tên tin tức chỉ được tối đa 255 ký tự'
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
				'required' => 'Tên tin tức không được để trống',
				'minlength' => 'Tên tin tức phải từ hai ký tự trở lên',
				'maxlength' => 'Tên tin tức chỉ được tối đa 255 ký tự'
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