<?php
require_once dirname(__FILE__) . '/Base.php';
class PzkCourseController extends PzkBaseController {
	public $grid = 'classes';
	public function studentAction() {
		$this->viewGrid('class_student');
	}
	
	public function scheduleAction() {
		$this->viewGrid('schedule');
	}
	
	public function layoutAction() {
		$this->viewGrid('layout');
	}
}