<?php
//[Add level]
class PzkAdminAdminlevelController extends PzkGridAdminController {
    public $addFields = 'level, status';
    public $editFields = 'level, status';
    public $table = 'admin_level';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'level asc' => 'Tên tăng',
        'level desc' => 'Tên giảm',

    );
    public $searchFields = array('level');
    public $listFieldSettings = array(
        array(
            'index' => 'level',
            'type' => 'text',
            'label' => 'Tên'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    public $addLabel = 'Thêm nhóm người dùng';
    public $addFieldSettings = array(
        array(
            'index' => 'level',
            'type' => 'text',
            'label' => 'Nhóm người dùng'
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
            'index' => 'level',
            'type' => 'text',
            'label' => 'Nhóm người dùng'
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
            'level' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'level' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            )

        )
    );
    public $editValidator = array(
        'rules' => array(
            'level' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'level' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
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