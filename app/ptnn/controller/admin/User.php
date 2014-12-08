<?php
class PzkAdminUserController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $addFields = 'name, username, email, address, phone, birthday, idpassport, iddate, idplace, status';
	public $editFields = 'name, username, email, address, phone, birthday, idpassport, iddate, idplace, status';
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
	public function editPostAction() {
		$row = $this->getEditData();
		if($this->validateEditData($row)) {
			$password = trim(pzk_request('password'));
			$confirmpassword = trim(pzk_request('confirmpassword'));
			if($password) {
				$passwordValidateResult = $this->validate(
					array( 'password' => $password ),
					array( 
						'rules' => array(
							'password' =>
								array(
									'minlength' => 6,
									'equalTo' => $confirmpassword)
						),
						'messages' => array(
							'password' =>
								array(
									'minlength' => 'Mật khẩu dài tối thiểu 6 ký tự',
									'equalTo' => 'Mật khẩu nhập lại không khớp')
						)
					)
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
			$passwordValidateResult = $this->validate(
				array( 'password' => $password ),
				array( 
					'rules' => array(
						'password' =>
							array(
								'required' => true,
								'minlength' => 6,
								'equalTo' => $confirmpassword)
					),
					'messages' => array(
						'password' =>
							array(
								'required' => 'Bạn phải nhập mật khẩu',
								'minlength' => 'Mật khẩu dài tối thiểu 6 ký tự',
								'equalTo' => 'Mật khẩu nhập lại không khớp')
					)
				)
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