<?php
class PzkDemoController extends PzkController {
	public $masterPage="demo";
	public $masterPosition = "left";
	public function indexAction() {
	}
	
	public function musterAction() {
		$this->render('operation/muster');
	}
	
	public function musterTabAction() {
		$classId = pzk_request('classId');
		$musterTab = $this->parse('operation/musterTab');
		$musterTab->classId = $classId;
		$musterTab->display();
	}
	
	public function musterPrintAction() {
		$classId = pzk_request('classId');
		$periodId = pzk_request('periodId');
		$musterPrint = $this->parse('operation/musterPrint');
		$musterPrint->classId = $classId;
		$musterPrint->periodId = $periodId;
		$musterPrint->display();
	}
	
	public function paymentstatAction() {
		$this->render('operation/paymentstat');
	}
	
	public function paymentstatTabAction() {
		$classId = pzk_request('classId');
		$paymentstatTab = $this->parse('operation/paymentstatTab');
		$paymentstatTab->classId = $classId;
		$paymentstatTab->display();
	}
	
	public function paymentstatPrintAction() {
		$classId = $_REQUEST['classId'];
		$periodId = $_REQUEST['periodId'];
		$paymentstatTab = $this->parse('operation/paymentstatPrint');
		$paymentstatTab->classId = $classId;
		$paymentstatTab->periodId = $periodId;
		$paymentstatTab->display();
	}
	
	public function musterclassAction() {
		$musterclass = $this->parse('operation/musterclass');
		$musterclass->display();
	}
	
	public function loginAction() {
		$page = $this->parse('login');
		$page->display();
	}
	
	public function loginPostAction() {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$permission = pzk_element('permission');
		
		if($permission->login($username, $password)) {
			$this->redirect('student/index');
		} else {
			$this->redirect('demo/login');
		}
	}
	
	public function logoutAction() {
		pzk_session('loginId', false);
		$this->redirect('demo/login');
	}
	
	public function reportAction() {
		$this->render('operation/report');
	}
	
	public function reportPostAction() {
		$password = $_REQUEST['password'];
		if($password != 'abc123') die('Bạn không có quyền xem báo cáo này');
		$reportType = $_REQUEST['reportType'];
		$this->initPage();
		$report = $this->parse('operation/report');
		$this->append($report);
		$reportResult = $this->parse('report/' . $reportType);
		foreach(array('reportType', 'teacherId', 'subjectId', 'classId', 'periodId') as $key) {
			$reportResult->$key = @$_REQUEST[$key];
			$elem = $report->findElement("[name=$key]");
			if($elem) {
				$elem->value = @$_REQUEST[$key];
			}
		}
		$left->append($reportResult);
		$page->display();
	}
	public function studentAction() {
		$this->redirect('student/index');
	}
}
