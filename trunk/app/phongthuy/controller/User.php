<?php
class PzkUserController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function loginPostAction() {
		$request = pzk_element('request');
		$username = $request->get('username');
		$password = $request->get('password');
		$permission = pzk_element('permission');
		if($permission->login($username, $password)) {
			header('Location: /');
		} else {
			$this->viewStructure('user/login');
		}
	}
	public function loginAction() {
		$this->viewStructure('user/login');
	}
	public function logoutAction() {
		pzk_session('loginId', false);
		header('Location: /');
	}
	public function registerAction() {
		$permission = pzk_element('permission');
		if($permission->user->get('type') != 'Guest') { header('Location: /'); return ;}
		$this->viewStructure('user/register');
	}
	public function registerPostAction() {
		$permission = pzk_element('permission');
		if($permission->user->get('type') != 'Guest') { header('Location: /'); return ;}
		$request = pzk_element('request');
		$fullName = trim($request->get('fullName'));
		$username = trim($request->get('username'));
		$password = trim($request->get('password'));
		$confirmPassword = trim($request->get('confirmPassword'));
		$email = trim($request->get('email'));
		$confirmEmail = trim($request->get('confirmEmail'));
		$phone = trim($request->get('phone'));
		$address = trim($request->get('address'));
		if(strlen($password) < 6 || $password != $confirmPassword || $email != $confirmEmail) {
			$this->viewStructure('user/register');
			return ;
		}
		$user = _db()->useCB()->select('*')->from('profile_profile')->where(array('username', $username))->result_one();
		if($user) {
			$this->viewStructure('user/register');
			return ;
		}
		$userEntity = _db()->getEntity('profile.profile');
		$userEntity->setData(array(
			'username' => $username,
			'password' => $password,
			'fullName' => $fullName,
			'email' => $email,
			'phone' => $phone,
			'address' => $address,
			'type' => 'User'
		));
		$userEntity->save();
		if($userEntity->get('id')) {
			
			if($permission->login($username, $password)) {
				header('Location: /');
			} else {
				$this->viewStructure('user/login');
			}
		} else {
			$this->viewStructure('user/register');
			return ;
		}
	}
	public function studyAction() {
		$this->viewStructure('user/study');
	}
	public function studyPostAction() {
		$request = pzk_element('request');
		$fullName = trim($request->get('fullName'));
		$email = trim($request->get('email'));
		$phone = trim($request->get('phone'));
		$address = trim($request->get('address'));
		$studierEntity = _db()->getEntity('profile.studier');
		$studierEntity->setData(array(
			'fullName' => $fullName,
			'email' => $email,
			'address' => $address,
			'phone' => $phone,
			'status' => 1
		));
		$studierEntity->save();
		if($studierEntity->get('id')) {
			$this->viewStructure('user/study/success');
		} else {
			$this->viewStructure('user/study');
		}
	}
}