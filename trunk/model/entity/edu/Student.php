<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityEduStudentModel extends PzkEntityModel {
	public $table = 'student';
	
	public function getAttendance($classperiodAttendance, $state) {
	}
	
	public function getClasses() {
		$query = 'select classes.* from classes inner join class_student on classes.id = class_student.classId where class_student.studentId=' . $this->getId();
		$classes = _db()->query($query);
		$result = array();
		foreach($classes as $class) {
			$obj = _db()->getEntity('edu.class');
			$obj->setData($class);
			$result[] = $obj;
		}
		return $result;
	}
	
	public function search($name, $phone, $classId, $periodId, $paymentState){
		$cond = "1";
		if($name) {
			$name = @mysql_real_escape_string($name);
			$cond .= " and name like '%$name%'";
		}
		if($phone) {
			$phone = @mysql_real_escape_string($phone);
			$cond .= " and phone like '%$phone%'";
		}
		if($classId) {
			$cond .= " and id in (select studentId from class_student where classId=$classId)";
		}
		if($periodId) {
			$period = _db()->select('*')->from('payment_period')->where('id='.$periodId)->result_one();
			$classCond = "select id from classes where startDate < '" . date('Y-m-d', strtotime($period['startDate']) + 30 * 24 * 3600) . "'";
			$cond .= " and id in (select studentId from class_student where classId in ($classCond))";
			if($paymentState) {
				if($paymentState == 2) {
					$paymentCond = "select studentId from payment_state where periodId=$periodId group by studentId having count(*) * $paymentState = sum(paymentState)";
					$cond .= " and id in ($paymentCond)";
				}
			}
		}
		
		$students = _db()->select('*')->from($this->table)->where($cond)->result('edu.student');
		return $students;
	}
}
