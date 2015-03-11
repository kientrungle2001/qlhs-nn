<?php
class PzkAdminGameController extends PzkGridAdminController {
	public $table = 'game';
	public $addFields = 'gametype,img,brief,url';
	public $editFields = 'gametype,img,brief,url';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'title asc' => 'Tiêu đề tăng',
		'title desc' => 'Tiêu đề giảm'
		
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'gametype',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),

		array(
            'index' => 'img',
            'type' => 'text',
            'label' => 'Ảnh đại diện'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn'
        ),
		array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả trò chơi'
        )
		
		

	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'gametype',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn'
        ),

		array(
            'index' => 'img',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh ',
        ),
		array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả trò chơi'
        )
		
    );
    public $editFieldSettings = array(
        array(
            'index' => 'gametype',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn'
        ),

		array(
            'index' => 'img',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh ',
        ),
		array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả trò chơi'
        )
		
    );
	public $addValidator = array(
		'rules' => array(
			'gametype' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'gametype' => array(
				'required' => 'Loại trò chơi không được để trống',
				'minlength' => 'Ít nhất phải từ hai ký tự',
				'maxlength' => 'Tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'gametype' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'gametype' => array(
				'required' => 'Loại trò chơi không được để trống',
				'minlength' => 'Ít nhất phải từ hai ký tự',
				'maxlength' => 'Tối đa 255 ký tự'
			)
		)
	);
}
	
?>