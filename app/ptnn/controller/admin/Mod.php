<?php
class PzkAdminModController extends PzkGridAdminController {
    public $table = 'admin';
    //joins to many table
    public $joins = array(
        array(
            'table' => 'admin_level',
            'condition' => 'admin.usertype_id = admin_level.id',
            'type' =>''
        )
    );
    //select table
    public $selectFields = 'admin.*, admin_level.level';
    //show fields on page index
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên User'
        ),
        array(
            'index' => 'level',
            'type' => 'text',
            'label' => 'Tên quyền'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    //search fields co type la text
    public $searchFields = array('name');
    public $Searchlabels = 'Tên';
    //filter cho cac truong co type la select
    public $filterFields = array(

        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

    //add table
    public $addFields = 'name, usertype_id, password, status';
    public $addLabel = 'Thêm user';

    //add theo dang binh thuong
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên người dùng'
        ),
        array(
            'index' => 'password',
            'type' => 'password',
            'label' => 'Password'
        ),
        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
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
            ),
            'password' =>
                array(
                    'minlength' => 4,
                )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            'password' =>
                array(
                    'minlength' => 'Mật khẩu dài tối thiểu 4 ký tự',
                )

        )
    );

    //edit table
    public $editFields = 'name, usertype_id, password, status';

    //edit theo dang binh thuong
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên người dùng'
        ),
        array(
            'index' => 'password',
            'type' => 'password',
            'label' => 'Password'
        ),
        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level'
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

    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            ),
            'password' =>
                array(
                    'minlength' => 4,
                )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            'password' =>
                array(
                    'minlength' => 'Mật khẩu dài tối thiểu 4 ký tự',
                )

        )
    );
    //add link menu
    //add menu links
    public $menuLinks = array(
        array(
            'name' => 'Import',
            'href' => '/admin_mod/import'
        ),

    );
    //export data
    public $exportFields = array('admin.id', 'admin.name', 'admin_level.level');
    public $exportTypes = array('pdf', 'excel', 'csv');
    //import
    public $importFields = array('level', 'username');
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
            $password = trim(pzk_request('password'));
            if($password) {
                $row['password'] = md5($password);
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            }
            else {
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $password = trim(pzk_request('password'));
            if($password) {
                $row['password'] = md5($password);

                $this->add($row);

                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            } else {
                pzk_validator()->setEditingData($row);
                $this->redirect('add');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }
}