<?php
require_once dirname(__FILE__) . '/Base.php';
class PzkStudentController extends PzkBaseController {
	public $grid = 'student';
	
	public function orderAction() {
		$this->viewGrid('student_order');
	}
	
	public function searchAction() {
		$this->viewOperation('student_search');
	}
	
	public function searchresultAction() {
		$student_list = $this->getOperationStructure('student_list');
		$student_list->name = @$_REQUEST['name'];
		$student_list->phone = @$_REQUEST['phone'];
		$student_list->classId = @$_REQUEST['classId'];
		$student_list->payment = @$_REQUEST['payment'];
		$student_list->payment_period = @$_REQUEST['payment_period'];
		$student_list->display();
	}
	
	public function detailAction() {
		$student_detail = $this->getOperationStructure('student_detail');
		$student_detail->studentId = @$_REQUEST['id'];
		$student_detail->display();
	}
}