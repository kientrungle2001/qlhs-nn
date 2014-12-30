<?php
class PzkAdminBannerController extends PzkGridAdminController {
	public $table = 'banner';
	public $addFields = 'ngaytao, url, title, code';
	public $editFields = 'ngaytao, url, title, code';
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
            'index' => 'code',
            'type' => 'text',
            'label' => 'Code'
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