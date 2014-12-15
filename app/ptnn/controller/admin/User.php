<?php
class PzkAdminUserController extends PzkGridAdminController {
	public $addFields = 'name, username, email, address, phone, birthday, idpassport, iddate, idplace, status';
	public $editFields = 'name, username, email, address, phone, birthday, idpassport, iddate, idplace, status';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'name asc' => 'Tên tăng',
		'name desc' => 'Tên giảm',
		'username asc' => 'Username tăng',
		'username desc' => 'Username giảm'
	);
	public $searchFields = array('name', 'username', 'email', 'phone', 'address');
	public $listFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên'
		),
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'email',
			'type' => 'text',
			'label' => 'Thư điện tử'
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Số điện thoại'
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
	);
	public $addLabel = 'Thêm người dùng';
	public $addFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Họ và tên'
		),
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'password',
			'type' => 'password',
			'label' => 'Mật khẩu'
		),
		array(
			'index' => 'confirmpassword',
			'type' => 'password',
			'label' => 'Xác nhận mật khẩu'
		),
		array(
			'index' => 'email',
			'type' => 'email',
			'label' => 'Thư điện tử'
		),
		array(
			'index' => 'birthday',
			'type' => 'date',
			'label' => 'Ngày sinh'
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ'
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Số điện thoại'
		),
		array(
			'index' => 'idpassport',
			'type' => 'text',
			'label' => 'Số CMT/Hộ chiếu'
		),
		array(
			'index' => 'iddate',
			'type' => 'date',
			'label' => 'Ngày cấp'
		),
		array(
			'index' => 'idplace',
			'type' => 'text',
			'label' => 'Nơi cấp'
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
			'label' => 'Họ và tên'
		),
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'password',
			'type' => 'password',
			'label' => 'Mật khẩu'
		),
		array(
			'index' => 'confirmpassword',
			'type' => 'password',
			'label' => 'Xác nhận mật khẩu'
		),
		array(
			'index' => 'email',
			'type' => 'email',
			'label' => 'Thư điện tử'
		),
		array(
			'index' => 'birthday',
			'type' => 'date',
			'label' => 'Ngày sinh'
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ'
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Số điện thoại'
		),
		array(
			'index' => 'idpassport',
			'type' => 'text',
			'label' => 'Số CMT/Hộ chiếu'
		),
		array(
			'index' => 'iddate',
			'type' => 'date',
			'label' => 'Ngày cấp'
		),
		array(
			'index' => 'idplace',
			'type' => 'text',
			'label' => 'Nơi cấp'
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
			'username' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			),
			'email' => array(
				'required' => true,
				'email' => true,
				'maxlength' => 50
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên không được để trống',
				'minlength' => 'Tên phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên chỉ dài tối đa 50 ký tự'
			),
			'username' => array(
				'required' => 'Tên đăng nhập không được để trống',
				'minlength' => 'Tên đăng nhập phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên đăng nhập chỉ dài tối đa 50 ký tự'
			),
			'email' => array(
				'required' => 'Email không được để trống',
				'email' => 'Email phải đúng định dạng',
				'maxlength' => 'Độ dài tối đa của email là 50 ký tự'
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
			'username' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			),
			'email' => array(
				'required' => true,
				'email' => true,
				'maxlength' => 50
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên không được để trống',
				'minlength' => 'Tên phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên chỉ dài tối đa 50 ký tự'
			),
			'username' => array(
				'required' => 'Tên đăng nhập không được để trống',
				'minlength' => 'Tên đăng nhập phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên đăng nhập chỉ dài tối đa 50 ký tự'
			),
			'email' => array(
				'required' => 'Email không được để trống',
				'email' => 'Email phải đúng định dạng',
				'maxlength' => 'Độ dài tối đa của email là 50 ký tự'
			)
		)
	);
	
	public $passwordValidator = array( 
		'rules' => array(
			'password' =>
				array(
					'minlength' => 6,
					'equalTo' => '')
		),
		'messages' => array(
			'password' =>
				array(
					'minlength' => 'Mật khẩu dài tối thiểu 6 ký tự',
					'equalTo' => 'Mật khẩu nhập lại không khớp')
		)
	);
	public function editPostAction() {
		$row = $this->getEditData();
		if($this->validateEditData($row)) {
			$password = trim(pzk_request('password'));
			$confirmpassword = trim(pzk_request('confirmpassword'));
			$this->passwordValidator['rules']['password']['equalTo'] = $confirmpassword;
			if($password) {
				$passwordValidateResult = $this->validate(
					array( 'password' => $password ),
					$this->passwordValidator
				);
				if($passwordValidateResult) {
					$row['password'] = md5($password);
					$this->edit($row);
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('index');
				} else {
					pzk_validator()->setEditingData($row);
					$this->redirect('edit/' . pzk_request('id'));
				}
				
			} else {
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
			$confirmpassword = trim(pzk_request('confirmpassword'));
			$this->passwordValidator['rules']['password']['equalTo'] = $confirmpassword;
			$passwordValidateResult = $this->validate(
				array( 'password' => $password ),
				$this->passwordValidator
			);
			if($passwordValidateResult) {
				$row['password'] = md5($password);
				$this->edit($row);
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