<?php
// --IGNORE--
class PzkHomeController extends PzkController{
	
	public function indexAction() {
		$page = pzk_parse($this->getApp()->getPageUri('index'));
		$page->title = 'Trang chủ';
		$page->display();
	}
	
	public function listAction() {
		var_dump($_REQUEST);
	}
	
	public function testAction() {
		$class = _db()->getEntity('edu.class')->load(39);
		$students = $class->getStudents();
		foreach($students as $student) {
			echo $student->get('name') . '<br />';
		}
	}
	public function testSqlAction() {
		/*
		$cond = array('in', 'id', array(1, 2, 3));
		$cond = array('and', $cond, array('in', 'id', array(2, 3, 4)));
		$query = _db()->useCB()->select('*')->from('student')->where($cond)->result();
		var_dump($query);
		$query = _db()->useCB()->select('*')->from('student')->where(array('id', 1))->result();
		var_dump($query);
		$cond = array('like', 'phone', '091%');
		$query = _db()->useCB()->select('*')->from('student')->where($cond)->limit(5, 0)->result();
		var_dump($query);
		$cond = array(array('like', 'phone', '091%'), array('like', 'name', '%Minh%'));
		$query = _db()->useCB()->select('*')->from('student')->where($cond)->limit(5, 0)->result();
		var_dump($query);
		*/
		$cond = array(array('like', array('column', 'student', 'phone'), '091%'), array('like', array('column', 'student', 'name'), '%Minh%'));
		$joinCond = array('equal', array('column', 'class_student', 'studentId'), array('column', 'student', 'id'));
		$classCond = array('equal', array('column', 'class_student', 'classId'), array('column', 'classes', 'id'));
		$query = _db()->useCB()->select('student.*, classes.name as className')
			->from('class_student')
			->join('student', $joinCond)
			->join('classes', $classCond)
			->where($cond)->limit(5, 0)->result();
		var_dump($query);
	}
	public function testSearchStudentAction() {
		$name = 'Huy Trung';
		$phone = '0916005558';
		$classId = '56';
		$periodId = '4';
		$paymentState = '0'; // tất cả
		$students = _db()->getEntity('edu.student')
				->search($name, $phone, $classId, $periodId, $paymentState);
		$this->assertEquals(count($students), 1);
	}
	
	public function assertEquals($value1, $value2) {
		if($value1 == $value2) {
			echo 'OK. Passed!<br />';
		} else {
			echo 'Wrong. Not Equals!<br />';
		}
	}
	
	public function testGenerateLinkAction() {
		$session_video = $_SESSION['video_session'] = time();
		$videoId = $_REQUEST['videoId'];
		$secret_key = 'k@ien';
		$keyid = md5($secret_key . $session_video . $videoId);
		$url = BASE_URL .'/home/download?keyid=' . $keyid . '&videoId=' . $videoId;
		echo '<a href="'.$url.'">Download</a>';
	}
	
	public function downloadAction() {
		$keyid = $_REQUEST['keyid'];
		$videoId = $_REQUEST['videoId'];
		$session_video = $_SESSION['video_session'];
		$secret_key = 'k@ien';
		$keyid2 = md5($secret_key . $session_video . $videoId);
		if($keyid == $keyid2) {
			echo 'Can download';
		}
	}
	
	public function testListAction() {
		$this->viewOperation('testlist', false);
	}
	public function testDetailAction() {
		$detail = $this->getStructure('operation/testdetail');
		$detail->itemId = 1;
		$detail->display();
	}
}
?>