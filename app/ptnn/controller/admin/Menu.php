<?php
class PzkAdminMenuController extends PzkGridAdminController {
    public $addFields = 'name, status, parent, admin_controller';
    public $editFields = 'name, status, parent, admin_controller';
    public $table = 'admin_menu';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'name asc' => 'ID tăng',
        'name desc' => 'ID giảm',
    );
    public $searchFields = array('name');
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'tên menu'
        ),

        array(
            'index' => 'admin_controller',
            'type' => 'text',
            'lable' => 'controller'
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
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên menu',
        ),
        array(
            'index' => 'content',
            'type' => 'tinymce',
            'label' => 'noi dung'
        ),
        array(
            'index' => 'parent',
            'type' => 'parent',
            'label' => 'Menu cha',
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
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên menu',
        ),
        array(
            'index' => 'parent',
            'type' => 'parent',
            'label' => 'Menu cha',
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
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        }

    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $this->add($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        }
    }
}
?>