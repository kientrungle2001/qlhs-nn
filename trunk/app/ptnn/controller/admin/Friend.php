<?php
class PzkAdminFriendController extends PzkGridAdminController {
	public $addFields = 'username, userfriend';
	public $editFields ='username, userfriend';
	public $table='friend';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'username asc' => 'Tên đăng nhập tăng',
		'username desc' => 'Tên đăng nhập giảm'
	);
	public $searchFields = array('username');
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'Tên đăng nhập bạn bè '
		)
	);
	public $addLabel = 'Thêm bạn mới';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'Tên đăng nhập bạn bè'
			
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'Tên đăng nhập bạn bè'
			
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userfriend' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'userfriend' => array(
				'required' => 'Tên bạn bè không được để trống',
				'minlength' => 'Tên bạn bè phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên bạn bè chỉ dài tối đa 50 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userfriend' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'userfriend' => array(
				'required' => 'Tên bạn bè không được để trống',
				'minlength' => 'Tên bạn bè phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên bạn bè chỉ dài tối đa 50 ký tự'
			)
		)
	);
}