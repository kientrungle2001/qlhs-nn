<?php
class PzkAdminBannerController extends PzkGridAdminController {
	public $table = 'banner';
	public $addFields = 'ngaytao, url, title';
	public $editFields = 'ngaytao, url, title';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'ngaytao asc' => 'Ngày tăng',
		'ngaytao desc' => 'Ngày giảm',
		'title asc' => 'Tiêu đề tăng',
		'title desc' => 'Tiêu đề giảm'
	);
	public $searchFields = array('title', 'url', 'ngaytao');
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
		array(
            'index' => 'click',
            'type' => 'text',
            'label' => 'Số lượt click'
        )
        
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
            'type' => 'date',
            'label' => 'Ngày tạo'
        ),
		array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
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
            'type' => 'date',
            'label' => 'Ngày tạo'
        ),
		
		array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
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