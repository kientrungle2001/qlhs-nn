<?php
class PzkAdminNewsController extends PzkGridAdminController {
	public $table = 'news';
	public $addFields = 'title, parent, content,brief,alias,begindate,enddate';
	public $editFields = 'title, parent, content,brief,alias,begindate,enddate';
	public $listFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên tin tức'
        ),

        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả'
        ),
		array(
            'index' => 'content',
            'type' => 'text',
            'label' => 'Nội dung'
        ),
		array(
            'index' => 'alias',
            'type' => 'text',
            'label' => 'Alias'
        ),
		array(
            'index' => 'begindate',
            'type' => 'text',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'enddate',
            'type' => 'text',
            'label' => 'Ngày kết thúc'
        ),
		array(
            'index' => 'active',
            'type' => 'text',
            'label' => 'Trạng thái'
        )
    );
    public $addLabel = 'Thêm menu';
    public $addFieldSettings = array(
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
            'index' => 'parent',
            'type' => 'parent',
            'label' => 'Menu cha',
			 'table' => 'news',
            'show_value' => 'title'
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
            'index' => 'parent',
            'type' => 'parent',
            'label' => 'Menu cha',
			 'table' => 'news',
            'show_value' => 'title'
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