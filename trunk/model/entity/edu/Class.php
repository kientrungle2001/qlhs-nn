<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityEduClassModel extends PzkEntityModel {
	public $table = 'classes';
	public function getStudents($orderBy = 'student.name') {
		$query = 'select student.* from student inner join class_student on student.id = class_student.studentId where class_student.classId=' . $this->get('id') . ' order by ' . $orderBy;
		$students = _db()->query($query);
		$result = array();
		foreach($students as $student) {
			$obj = _db()->getEntity('edu.student');
			$obj->setData($student);
			$result[] = $obj;
		}
		return $result;
	}
}
