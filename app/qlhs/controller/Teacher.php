<?php
require_once dirname(__FILE__) . '/Base.php';
class PzkTeacherController extends PzkBaseController {
	public $grid = 'teacher';
	public function loginAction() {
		$page = pzk_parse($this->getApp()->getPageUri('login'));
		pzk_element('loginForm')->action = BASE_REQUEST . '/teacher/loginPost';
		$page->display();
	}
	
	public function loginPostAction() {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$permission = pzk_element('permission');
		
		if($permission->teacherLogin($username, $password)) {
			header('Location: '. BASE_REQUEST . '/teacher/info');
		} else {
			header('Location: '. BASE_REQUEST . '/teacher/login');
		}
	}
	public function infoAction() {
		$this->viewOperation('teacher_info');
	}
	public function changePasswordAction() {
		$this->viewOperation('teacher_password');
	}
	public function changePasswordPostAction() {
		$teacherId = pzk_session('teacherId');
		$request = pzk_request();
		if($teacherId) {
			$teacher = _db()->getEntity('edu.teacher')->load($teacherId);
			if($teacher->getPassword() == $request->get('oldPassword')) {
				if($request->get('password') == $request->get('confirmPassword')) {
					$teacher->setPassword($request->get('password'));
					$teacher->save();
					header('Location: '. BASE_REQUEST . '/teacher/info');die();
				}
			}
			header('Location: '. BASE_REQUEST . '/teacher/changePassword');
		} else {
			header('Location: '. BASE_REQUEST . '/teacher/login');
		}
	}
}