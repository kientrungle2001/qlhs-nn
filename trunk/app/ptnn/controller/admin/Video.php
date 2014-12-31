<?php
class PzkAdminVideoController extends PzkGridAdminController {
    public $addFields = 'url, status, category_id';
    public $editFields = 'url, status, category_id';
    public $table = 'video';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'name asc' => 'ID tăng',
        'name desc' => 'ID giảm',
    );
    public $searchFields = array('name');
    public $listFieldSettings = array(
        array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'tên menu'
        ),


        array(
            'index' => 'status',
            'type' => 'status',
            'lable' => 'status'
        )
    );
    public $addLabel = 'Thêm menu';
    public $addFieldSettings = array(
        array(
            'index' => 'url',
            'type' => 'file',
            'label' => 'Chọn Video',
        ),

        array(
            'index' => 'category_id',
            'type' => 'parent',
            'label' => 'Menu cha',
            'table' => 'categories',
            'show_value' => 'name'
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
            'index' => 'url',
            'type' => 'file',
            'label' => 'Chọn Video',
        ),


        array(
            'index' => 'parent',
            'type' => 'parent',
            'label' => 'Menu cha',
            'table' => 'admin_menu',
            'show_value' => 'name'
        ),
        array(
            'index' => 'admin_controller',
            'type' => 'admin_controller',
            'label' => 'tên controller'
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
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

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
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );

    public function addPostAction() {
        
    }
}
?>