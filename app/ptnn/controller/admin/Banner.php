<?php
class PzkAdminBannerController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = 'banner';
	public $addFields = 'ngaytao, click, title, img, code';
	public $editFields = 'ngaytao, click, title, img, code';
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
				
		 $addbanner=array(
                    'title'=>$post['title'],
					'ngaytao'=>$post['ngaytao'],
					'click'=>$post['click']);
										        
												$entity = _db()->useCb()->getEntity('table')->setTable('banner');
                $entity->setData($addbanner);
                $entity->save();
				
		}
				
		$this->initPage();
		$banner = pzk_parse(pzk_app()->getPageUri('admin/banner/add'));
		$banner->setParentId(pzk_request()->getSegment(3));
		
		$this	->append($banner)
				->append('admin/banner/menu','right')
				->display();
	}
}