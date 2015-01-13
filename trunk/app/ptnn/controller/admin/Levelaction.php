<?php
class PzkAdminLevelactionController extends PzkGridAdminController {
    public $addFields = 'admin_action, admin_level_id, admin_level, name_menu, action_type, status';
    public $editFields = 'admin_action, admin_level_id, admin_level, name_menu, action_type, status';
    public $table = 'admin_level_action';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',


    );

    public $searchFields = array('admin_level');
    public $Searchlabels ='Tên quyền';

    public $filterFields = array(

        array(
            'index' => 'admin_action',
            'type' => 'select',
            'label' => 'Tên menu',
            'table' => 'admin_menu',
            'show_value' => 'admin_controller',
            'show_name' => 'name',
        ),
        array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )

    );

    public $linkRightMenu = array(
        array(
            'name' => 'demo',
            'href' => '/admin_levelaction/index'
        ),
        array(
            'name' => 'demo2',
            'href' => '/admin_levelaction/index'
        ),
    );

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
            'index' => 'action_type',
            'type' => 'text',
            'label' => 'Cấm quyền'
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
            'index' => 'admin_level_id',
            'type' => 'selectInput',
            'label' => 'Nhóm người dùng',
            'table'=>'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
            'hidden'=>'admin_level'

        ),
        array(
            'index' => 'admin_action',
            'type' => 'selectInput',
            'label' => 'tên menu',
            'table' => 'admin_menu',
            'show_value' => 'admin_controller',
            'show_name' => 'name',
            'hidden'=>'name_menu'
        ),
        array(
            'index' => 'action_type',
            'type' => 'select_fix',
            'label' => 'Cấm quyền',

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
            'index' => 'admin_level_id',
            'type' => 'selectInput',
            'label' => 'Nhóm người dùng',
            'table'=>'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
            'hidden'=>'admin_level'

        ),

        array(
            'index' => 'admin_action',
            'type' => 'selectInput',
            'label' => 'ten controller',
            'table' => 'admin_menu',
            'show_value' => 'admin_controller',
            'show_name' => 'name',
            'hidden'=>'name_menu'
        ),

        array(
            'index' => 'action_type',
            'type' => 'select_fix',
            'label' => 'Cấm quyền',

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