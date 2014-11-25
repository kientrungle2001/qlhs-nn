<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityEduClassModel extends PzkEntityModel {
	public $table = 'classes';
	public function getStudents($orderBy = 'student.name', $studentId = null) {
		$query = 'select student.*, 
			class_student.note, class_student.id as classStudentId, 
			class_student.startClassDate, 
			class_student.endClassDate,
			class_student.classId,
			classes.startDate, classes.endDate
			from student 
				inner join class_student on student.id = class_student.studentId
				inner join classes on class_student.classId = classes.id				
			where class_student.classId=' . $this->getId() . ($studentId? ' and class_student.studentId='.$studentId: '' ) . ' order by ' . $orderBy;
		$students = _db()->query($query);
		$result = array();
		foreach($students as $student) {
			$obj = _db()->getEntity('edu.student');
			$obj->setData($student);
			$result[] = $obj;
		}
		return $result;
	}
	public function getPeriods() {
		$conds = array('and');
		if($this->getStartDate() !== '0000-00-00') {
			$conds[] = array('or', array('gte', 'startDate', $this->getStartDate()), array('gt', 'endDate', $this->getStartDate()));
		}
		if($this->getEndDate() !== '0000-00-00') {
			$conds[] = array('or', array('lte', 'startDate', $this->getEndDate()), array('lt', 'endDate', $this->getEndDate()));
		}
		$conds[] = array('status', '1');
		return _db()->useCB()->select('*')->from('payment_period')
			->where($conds)->orderBy('startDate asc')->result('edu.period');
	}
}
