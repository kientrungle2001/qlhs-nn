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
		$periods = _db()->useCB()->select('*')->fromPayment_period()
			->where($conds)->orderBy('startDate asc')->result('edu.period');
		$periodByIds = array();
		foreach($periods as $period) {
			$periodByIds[$period->getId()] = $period;
		}
		return $periodByIds;
	}
	
	public function getRawStudents() {
		$rows = _db()->useCB()->select('student.id, student.phone, student.name, class_student.endClassDate, class_student.startClassDate')
			->fromClass_student()
			->joinStudent('class_student.studentId=student.id')
			->whereClassId($this->getId())
			->orderBy('student.name asc')
			->result('edu.student');
		$students = array();
		foreach($rows as $row) {
			$students[$row->getId()] = $row;
		}
		return $students;
	}
	
	public function getStudentIdPaids() {
		$orders = _db()->useCB()->select('studentId')
			->fromStudent_order()
			->whereClassId($this->getId())
			->whereStatus('')
			->result();
		$payments = array();
		foreach($orders as $order) {
			$payments[$order['studentId']] = true;
		}
		$paymentEntity = _db()->getEntity('edu.payment');
		$paymentEntity->setPaids($payments);
		return $paymentEntity;
	}
	
	public function isVMT() {
		return $this->getSubjectId() == 3;
	}
	
	public function getAmountFormated() {
		return product_price($this->getAmount());
	}
	
	public function getSchedules($startDate, $endDate) {
		return _db()->useCB()->select('studyDate')->fromSchedule()
			->whereClassId($this->getId())
			->gteStudyDate($startDate)
			->ltStudyDate($endDate)
			->orderBy('studyDate asc')->result();
	}
	
	public function getSchedulesOfPeriods($periods) {
		$minStartDate = 0; $maxEndDate = 0;
		foreach($periods as $period) {
			if($minStartDate == 0 || $minStartDate > $period->getStartDate())
				$minStartDate = $period->getStartDate();
			if($maxEndDate == 0 || $maxEndDate < $period->getEndDate())
				$maxEndDate = $period->getEndDate();
		}
		return $this->getSchedules($minStartDate, $maxEndDate);
	}
}
