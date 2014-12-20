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
				'required' => 'Tên banner không được để trống',
				'minlength' => 'Tên banner phải từ hai ký tự trở lên',
				'maxlength' => 'Tên banner chỉ được tối đa 255 ký tự'
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
				'required' => 'Tên banner không được để trống',
				'minlength' => 'Tên banner phải từ hai ký tự trở lên',
				'maxlength' => 'Tên banner chỉ được tối đa 255 ký tự'
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