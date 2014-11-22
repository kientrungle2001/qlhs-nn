<?php
class PzkDemoController extends PzkController {
	public function indexAction() {
	}
	
	public function entityAction() {
		$class = _db()->select('*')->from('classes')->where('id=60')->result_one('edu.class');
		// hoặc $class = _db()->getEntity('edu.class')->load(60);
		$students = $class->getStudents();
		echo 'Danh sách lớp: ' . $class->getName() . '<br />'; 
		foreach($students as $student) {
			$classes = $student->getClasses();
			echo $student->getName();
			echo ' học lớp ';
			foreach($classes as $c) {
				echo $c->getName() . ' ';
			}
			echo '<br />';
		}
	}
	
	public function musterAction() {
		$page = pzk_parse($this->getApp()->getPageUri('demo'));
		pzk_element('left')->append(pzk_parse($this->getApp()->getPageUri('operation/muster')));
		$page->display();
	}
	
	public function musterTabAction() {
		$classId = $_REQUEST['classId'];
		$musterTab = pzk_parse($this->getApp()->getPageUri('operation/musterTab'));
		$musterTab->classId = $classId;
		$musterTab->display();
	}
	
	public function musterPrintAction() {
		$classId = $_REQUEST['classId'];
		$periodId = $_REQUEST['periodId'];
		$musterPrint = pzk_parse($this->getApp()->getPageUri('operation/musterPrint'));
		$musterPrint->classId = $classId;
		$musterPrint->periodId = $periodId;
		$musterPrint->display();
	}
	
	public function paymentstatAction() {
		$page = pzk_parse($this->getApp()->getPageUri('demo'));
		pzk_store_element('left')->append(pzk_parse($this->getApp()->getPageUri('operation/paymentstat')));
		$page->display();
	}
	
	public function paymentstatTabAction() {
		$classId = $_REQUEST['classId'];
		$paymentstatTab = pzk_parse($this->getApp()->getPageUri('operation/paymentstatTab'));
		$paymentstatTab->classId = $classId;
		$paymentstatTab->display();
	}
	
	public function paymentstatPrintAction() {
		$classId = $_REQUEST['classId'];
		$periodId = $_REQUEST['periodId'];
		$paymentstatTab = pzk_parse($this->getApp()->getPageUri('operation/paymentstatPrint'));
		$paymentstatTab->classId = $classId;
		$paymentstatTab->periodId = $periodId;
		$paymentstatTab->display();
	}
	
	public function musterclassAction() {
		$musterclass = pzk_parse($this->getApp()->getPageUri('operation/musterclass'));
		$musterclass->display();
	}
	
	public function loginAction() {
		$page = pzk_parse($this->getApp()->getPageUri('login'));
		$page->display();
	}
	
	public function loginPostAction() {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$permission = pzk_element('permission');
		
		if($permission->login($username, $password)) {
			header('Location: '. BASE_URL . '/index.php/student');
		} else {
			header('Location: '. BASE_URL . '/index.php/demo/login');
		}
	}
	
	public function logoutAction() {
		pzk_session('loginId', false);
		header('Location: '. BASE_URL . '/index.php/demo/login');
	}
	
	public function reportAction() {
		$page = pzk_parse($this->getApp()->getPageUri('demo'));
		pzk_store_element('left')->append(pzk_parse($this->getApp()->getPageUri('operation/report')));
		$page->display();
	}
	
	public function reportPostAction() {
		$reportType = $_REQUEST['reportType'];
		$page = pzk_parse($this->getApp()->getPageUri('demo'));
		$left = pzk_store_element('left');
		$report = pzk_parse($this->getApp()->getPageUri('operation/report'));
		$left->append($report);
		$reportResult = pzk_parse($this->getApp()->getPageUri('report/' . $reportType));
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
		header('Location: ' . BASE_REQUEST . '/student');
	}
}
