<?php
class PzkAdminBannerController extends PzkGridAdminController {
	public $table = 'banner';
	public $addFields = 'ngaytao, url, title, code,status';
	public $editFields = 'ngaytao, url, title, code,status';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'ngaytao asc' => 'Ngày tăng',
		'ngaytao desc' => 'Ngày giảm',
		'title asc' => 'Tiêu đề tăng',
		'title desc' => 'Tiêu đề giảm'
	);
	public $searchFields = array('title', 'url', 'ngaytao', 'code', 'status');
		public $listFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên banner'
        ),
        array(
            'index' => 'ngaytao',
            'type' => 'text',
            'label' => 'Ngày tạo'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'URL'
        ),
        
    );
    public $addLabel = 'Thêm menu';
    public $addFieldSettings = array(
          array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên banner'
        ),
        array(
            'index' => 'ngaytao',
            'type' => 'text',
            'label' => 'Ngày tạo'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'URL'
        ),
        array(
            'index' => 'code',
            'type' => 'text',
            'label' => 'Code'
        ),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Trạng thái',
			'options' => array(
				'0' => 'Không hoạt động',
				'1' => 'Hoạt động'
			),
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
		)
    );
    public $editFieldSettings = array(
          array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên banner'
        ),
        array(
            'index' => 'ngaytao',
            'type' => 'text',
            'label' => 'Ngày tạo'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'URL'
        ),
        array(
            'index' => 'code',
            'type' => 'text',
            'label' => 'Code'
        ),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Trạng thái',
			'options' => array(
				'0' => 'Không hoạt động',
				'1' => 'Hoạt động'
			),
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
		)
		
    );
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
	
}