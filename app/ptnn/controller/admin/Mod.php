<?php
class PzkAdminModController extends PzkAdminController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $table = 'admin';
    public $addFields = 'name, usertype_id, password, status';
    public $editFields = 'name, usertype_id, password, status';
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên người dùng không được để trống',
                'minlength' => 'Tên người dùng phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên người dùng chỉ dài tối đa 255 ký tự'
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên người dùng không được để trống',
                'minlength' => 'Tên người dùng phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên người dùng chỉ dài tối đa 255 ký tự'
            )
        )
    );

    public $passwordValidator = array(
        'rules' => array(
            'password' =>
                array(
                    'minlength' => 4,
                    )
        ),
        'messages' => array(
            'password' =>
                array(
                    'minlength' => 'Mật khẩu dài tối thiểu 4 ký tự',
                    )
        )
    );
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