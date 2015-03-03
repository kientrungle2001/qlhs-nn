<?php
class PzkAdminTopicsController extends PzkGridAdminController {
	
	public $titleController = 'Topics';
	public $table = 'topics';
	public $listFieldSettings = array(
			array(
					'index' => 'id',
					'type' => 'text',
					'label' => 'ID'
			),
			array(
					'index' => 'name',
					'type' => 'text',
					'label' => 'Chủ đề'
			)
	);
	
	public $searchFields = array('name');
	public $Searchlabels = 'Chủ đề';
	
	public $addFields = 'name, createdId, created, modifiedId, modified';
	public $addLabel = 'Thêm chủ đề';
	
	public $addFieldSettings = array(
			array(
					'index' => 'name',
					'type' => 'text',
					'label' => 'Chủ đề'
			),
	);
	
	
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên chủ điểm không được để trống',
				'minlength' => 'Tên chủ điểm phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên chủ điểm chỉ dài tối đa 255 ký tự'
			)
		)
	);
	
	public $editLabel = 'Sửa chủ đề';
	public $editFields = 'name, createdId, created, modifiedId, modified';
	
	public $editFieldSettings = array(
			array(
					'index' => 'name',
					'type' => 'text',
					'label' => 'Chủ đề'
			)
	);
	
	public $editValidator = array(
			'rules' => array(
					'name' => array(
							'required' => true,
							'minlength' => 2,
							'maxlength' => 50
					)
	
			),
			'messages' => array(
					'name' => array(
							'required' => 'Chủ đề không được để trống',
							'minlength' => 'Chủ đề phải dài 2 ký tự trở lên',
							'maxlength' => 'Chủ đề chỉ dài tối đa 50 ký tự'
					)
			)
	);
}