<?php
// --IGNORE--
class PzkHomeController extends PzkController{
	
	public function indexAction() {
		$page = pzk_parse($this->getApp()->getPageUri('index'));
		$page->title = 'Trang chủ';
		$page->display();
	}
	
	public function smartyAction() {
		$smarty = $this->parse('smarty');
		$smarty->display();
	}
	
	public function studentAction() {
		set_time_limit(0);
		$query = "select student.*, group_concat(distinct(classes.name), ' ') as currentClassNames,
			group_concat('[', classes.name, ' ', case when student_order.payment_periodId = 0 then 'Cả khóa' else payment_period.name end, ']<br />' order by classes.name) as periodNames,
				group_concat('[', payment_period.id, ']') as periodIds from student 
					left join `class_student` on student.id = class_student.studentId
					left join `classes` on class_student.classId = classes.id
					left join `student_order` on student.id = student_order.studentId
						and classes.id = student_order.classId and student_order.status='' or student_order.status is null
					left join payment_period on student_order.payment_periodId = payment_period.id where 1 AND 1 AND 1 group by student.id order by student.id desc";
		$items = _db()->query($query);
		foreach($items as $item) {
			$student = _db()->getEntity('edu.student');
			$student->setData($item);
			$student->update(array('currentClassNames' => $item['currentClassNames'], 'periodNames' => $item['periodNames'], 'periodIds' => $item['periodIds']));
			echo 'complete ' . $student->getId() . '<br />';
		}
		echo 'success';
	}
	
	public function testAction() {
		$classStudents = _db()
				->selectNone()->selectClassId()
				->selectStudentId()->selectStatus()
				->selectStudyDate()
				->fromStudent_schedule()->result();
		$arr = pzk_array();
		$arr->setData($classStudents);
		//$rs = $arr->groupBy(array('classId', 'studentId', 'status'));
		//var_dump($rs[8][4]);
		$arr->sortBy(array(array('classId', 'asc'), array('studentId', 'asc'), array('studyDate', 'asc'), array('status', 'asc')));
		//var_dump($arr->getData());
		echo 1;
	}
}
