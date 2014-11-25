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
}