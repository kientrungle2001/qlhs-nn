<?php
class PzkAdminUserController extends PzkController {
	public function indexAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$user = pzk_parse(pzk_app()->getPageUri('admin/user/index'));
		pzk_element('left')->append($user);
		$this->appendMenu();
		$page->display();
	}
	public function editAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$user = pzk_parse(pzk_app()->getPageUri('admin/user/edit'));
		$user->setItemId(pzk_request()->getSegment(3));
		pzk_element('left')->append($user);
		$this->appendMenu();
		$page->display();
	}
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
		_db()->useCB()->update('user')
			->set($row)
			->where(array('id', pzk_request()->get('id')))->result();
		header('Location: /admin_user/index');
	}
	public function addAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$user = pzk_parse(pzk_app()->getPageUri('admin/user/add'));
		$user->setParentId(pzk_request()->getSegment(3));
		pzk_element('left')->append($user);
		$this->appendMenu();
		$page->display();
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
		_db()->useCB()->insert('user')
			->fields(implode(',', array_keys($row)))
			->values(array($row))
			->result();
		header('Location: /admin_user/index');
	}
	public function delAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$user = pzk_parse(pzk_app()->getPageUri('admin/user/del'));
		$user->setItemId(pzk_request()->getSegment(3));
		pzk_element('left')->append($user);
		$this->appendMenu();
		$page->display();
	}
	public function delPostAction() {
		_db()->useCB()->delete()->from('user')
			->where(array('id', pzk_request()->get('id')))->result();
		header('Location: /admin_user/index');
	}
	public function appendMenu() {
		pzk_element('right')->append(pzk_parse(pzk_app()->getPageUri('admin/user/menu')));
	}
}