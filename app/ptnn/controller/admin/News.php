<?php
class PzkAdminNewsController extends PzkGridAdminController {
	public $table = 'news';
	public $addFields = 'title, parent,title,img, content,brief,alias';
	public $editFields = 'title, parent, title,img,content,brief,alias';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'title asc' => 'Tiêu đề tăng',
		'title desc' => 'Tiêu đề giảm'
		
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên tin tức'
        ),

		array(
            'index' => 'views',
            'type' => 'text',
            'label' => 'Lượt Xem'
        ),
		array(
            'index' => 'comments',
            'type' => 'text',
            'label' => 'Lượt bình luận'
        )
		
		

	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên tin tức',
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
            'label' => 'Mô tả'
        ),
        array(
            'index' => 'content',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        ),
		array(
            'index' => 'alias',
            'type' => 'text',
            'label' => 'Alias'
        ),
        array(
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'news',
            'show_value' => 'id',
            'show_name' => 'title'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên tin tức',
        ),
		array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả'
        ),
        array(
            'index' => 'content',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        ),
		array(
            'index' => 'alias',
            'type' => 'text',
            'label' => 'Alias'
        ),
		array(
            'index' => 'img',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh ',
        ),
        array(
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'news',
            'show_value' => 'id',
            'show_name' => 'title'
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
}
	
?>