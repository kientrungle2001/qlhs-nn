<?php
class PzkAdminQuestionsController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public function editPostAction() {
		$name = pzk_request()->get('name');
		$username = pzk_request()->get('username');
		$password = pzk_request()->get('password');
		$confirmpassword = pzk_request()->get('confirmpassword');
		$email = pzk_request()->get('email');
		$address = pzk_request()->get('address');
		$phone = pzk_request()->get('phone');
		$birthday = pzk_request()->get('birthday');
		$idpassport = pzk_request()->get('idpassport');
		$iddate = pzk_request()->get('iddate');
		$idplace = pzk_request()->get('idplace');
		$status = pzk_request()->get('status');
		$row = array(
			'name' => $name, 
			'username' => $username,
			'email' => $email,
			'address' => $address,
			'phone' => $phone,
			'birthday' => $birthday,
			'idpassport' => $idpassport,
			'iddate' => $iddate,
			'idplace' => $idplace,
			'status' => $status
		);
		if($password && ($password == $confirmpassword)) {
			$row['password'] = md5($password);
		}
		$entity = _db()->getEntity('table');
		$entity->setTable('user');
		$entity->load(pzk_request()->get('id'));
		$entity->update($row);
		$this->redirect('edit/' . $entity->getId());
		$this->redirect('index');
	}
	public function addPostAction() {
		$name = pzk_request()->get('name');
		$username = pzk_request()->get('username');
		$password = pzk_request()->get('password');
		$email = pzk_request()->get('email');
		$address = pzk_request()->get('address');
		$phone = pzk_request()->get('phone');
		$birthday = pzk_request()->get('birthday');
		$idpassport = pzk_request()->get('idpassport');
		$iddate = pzk_request()->get('iddate');
		$idplace = pzk_request()->get('idplace');
		$row = array(
			'name' => $name, 
			'username' => $username,
			'password' => md5($password),
			'email' => $email,
			'address' => $address,
			'phone' => $phone,
			'birthday' => $birthday,
			'idpassport' => $idpassport,
			'iddate' => $iddate,
			'idplace' => $idplace
		);
		$entity = _db()->getEntity('table');
		$entity->setTable('user');
		$entity->setData($row);
		$entity->save();
		$this->redirect('edit/' . $entity->getId());
	}
}