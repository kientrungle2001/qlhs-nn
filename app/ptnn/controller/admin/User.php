<?php
class PzkAdminUserController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $addFields = 'name, username, email, address, phone, birthday, idpassport, iddate, idplace, status';
	public $editFields = 'name, username, email, address, phone, birthday, idpassport, iddate, idplace, status';
	public function editPostAction() {
		$row = $this->getEditData();
		if($password && ($password == $confirmpassword)) {
			$row['password'] = md5($password);
		}
		$this->edit($row);
		$this->redirect('index');
	}
	public function addPostAction() {
		$password = pzk_request()->get('password');
		$row = $this->getAddData();
		$row['password'] = md5($password);
		$this->add($row);
		$this->redirect('edit/' . $entity->getId());
	}
}