<?php
class PzkAdminNewsController extends PzkGridAdminController {
	public $table = 'news';
	public $addFields = 'title, parent,titlenew, content,brief,alias,begindate,enddate';
	public $editFields = 'title, parent, titlenew,content,brief,alias,begindate,enddate';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'title asc' => 'Tiêu đề tăng',
		'title desc' => 'Tiêu đề giảm',
		'content asc' => 'Nội dung tăng',
		'content desc' => 'Nội dung giảm',
		'brief asc' => 'Miêu tả tăng',
		'brief desc' => 'Miêu tả giảm',
		'alias asc' => 'Đường dẫn tăng',
		'alias desc' => 'Đường dẫn giảm',
		'begindate asc' => 'Ngày bắt đầu tăng',
		'begindate desc' => 'Ngày bắt đầu giảm',
		'enddate asc' => 'Ngày kết thúc tăng',
		'enddate desc' => 'Ngày kết thúc giảm'
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Tên tin tức'
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
            'index' => 'begindate',
            'type' => 'date',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'enddate',
            'type' => 'date',
            'label' => 'Ngày kết thúc'
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
            'index' => 'begindate',
            'type' => 'date',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'enddate',
            'type' => 'date',
            'label' => 'Ngày kết thúc'
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
	
function newAction(){
	
	
	
}

}