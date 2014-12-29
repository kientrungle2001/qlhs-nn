<?php
class PzkAdminLevelactionController extends PzkGridAdminController {
    public $addFields = 'admin_action, admin_level, name_menu, status';
    public $editFields = 'admin_action, admin_level, name_menu, status';
    public $table = 'admin_level_action';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',


    );
    public $searchFields = array('admin_level');
    public $listFieldSettings = array(
        array(
            'index' => 'admin_level',
            'type' => 'text',
            'label' => 'Tên quyền'
        ),
        array(
            'index' => 'name_menu',
            'type' => 'text',
            'label' => 'Tên menu'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    public $addLabel = 'Thêm quyền';
    public $addFieldSettings = array(
        array(
            'index' => 'admin_level',
            'type' => 'category',
            'label' => 'Nhóm người dùng',
            'table'=>'admin_level'

        ),
        array(
            'index' => 'admin_action',
            'type' => 'select',
            'label' => 'ten controller',
            'table' => 'admin_menu',
            'show_value' => 'admin_controller',
            'show_name' => 'name',
            'hidden'=>'name_menu'
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
            'index' => 'admin_level',
            'type' => 'category',
            'label' => 'Nhóm người dùng',
            'table'=>'admin_level'

        ),

        array(
            'index' => 'admin_action',
            'type' => 'select',
            'label' => 'ten controller',
            'table' => 'admin_menu',
            'show_value' => 'admin_controller',
            'show_name' => 'name',
            'hidden'=>'name_menu'
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
            'admin_action' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'admin_action' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            )

        )
    );
    public $editValidator = array(
        'rules' => array(
            'admin_action' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'admin_action' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            )

        )
    );

    public function getAdminLevel() {
        $data = _db()->useCB()->select('id, level')->from('admin_level')->where(array('status', 1))->result();
        $option = array();
        foreach($data as $item) {
            $option[$item['level']] = $item['level'];
        }
        return $option;
    }

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