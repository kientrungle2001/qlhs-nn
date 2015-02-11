<?php
class PzkAdminUserNoteController extends PzkGridAdminController {
	public $addFields = 'username,titlenote, contentnote, datenote, view, comment';
	public $editFields = 'username,titlenote, contentnote, datenote, view, comment';
	public $table='user_note';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'username asc' => 'Tên đăng nhập tăng',
		'username desc' => 'Tên đăng nhập giảm',
		'titlenote asc' => 'Tiêu đề tăng',
		'titlenote desc' => 'Tiêu đề giảm',
		'contentnote asc' => 'Nội dung tăng',
		'contentnote desc' => 'Nội dung giảm'
	);
	public $searchFields = array('username','titlenote','contentnote');
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên user'
		),
		array(
			'index' => 'titlenote',
			'type' => 'text',
			'label' => 'Tiêu đề '
		),
		array(
			'index' => 'contentnote',
			'type' => 'text',
			'label' => 'Nội dung'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên user'
		),
		array(
			'index' => 'titlenote',
			'type' => 'text',
			'label' => 'Tiêu đề '
		),
		array(
			'index' => 'contentnote',
			'type' => 'text',
			'label' => 'Nội dung'
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên user'
		),
		array(
			'index' => 'titlenote',
			'type' => 'text',
			'label' => 'Tiêu đề '
		),
		array(
			'index' => 'contentnote',
			'type' => 'text',
			'label' => 'Nội dung'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'titlenote' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'titlenote' => array(
				'required' => 'tiêu đề không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'titlenote' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'titlenote' => array(
				'required' => 'tiêu đề không được để trống'
				
			)
		)
	);


}