<?php
class PzkEduReportTeacher extends PzkObject {
	public $layout = 'edu/report/teacher';
	public $teacherId;
	public $periodId;
	public $classId;
	
	public function getSummary() {
		$cond = "1";
		$cond1 = "1";
		$cond2 = "1";
		if(intval($this->teacherId)) {
			$teacherId = $this->teacherId;
			$cond1 = "($cond1 and classes.teacherId='$teacherId')";
			$cond2 = "($cond2 and classes.teacher2Id='$teacherId')";
		}
		if(intval($this->classId)) {
			$classId = $this->classId;
			$cond1 = "($cond1 and classes.id='$classId')";
			$cond2 = "($cond2 and classes.id='$classId')";
		}
		if(intval($this->subjectId)) {
			$subjectId = $this->subjectId;
			$cond1 = "($cond1 and classes.subjectId='$subjectId')";
			$cond2 = "($cond2 and classes.subjectId='$subjectId')";
		}
		if(intval($this->periodId)) {
			$periodId = $this->periodId;
			$period = _db()->select('*')->from('payment_period')->where('id=' . $periodId)->result_one();
			$startDate = $period['startDate'];
			$endDate = $period['endDate'];
			$cond = "($cond and student_schedule.studyDate >='$startDate' and student_schedule.studyDate < '$endDate')";
		}
		
		$query = "(select classes.teacherId,concat((MONTH(student_schedule.studyDate)+1) div 2,'-', YEAR(student_schedule.studyDate)) as studyMonth, 
		classes.`name` as className, classes.amount as classAmount, teacher.name as teacherName, teacher.salary as teacherSalary, 
		student_schedule.classId, student_schedule.`status`, count(student_schedule.id) as statusCount,
		classes.amount * count(student_schedule.id) as classTotal,
		classes.amount * count(student_schedule.id) * teacher.salary / 100 as teacherTotal,
		classes.amount * count(student_schedule.id) * (100-teacher.salary) / 100 as centerTotal,
		COUNT(DISTINCT student_schedule.studyDate) as countStudyDate, 
		COUNT(DISTINCT student_schedule.studentId) as countStudent
from student_schedule 
			inner join teacher_schedule on student_schedule.classId = teacher_schedule.classId and student_schedule.studyDate = teacher_schedule.studyDate
			inner join classes on student_schedule.classId = classes.id and teacher_schedule.teacherId = classes.teacherId 
			INNER JOIN teacher on classes.teacherId = teacher.id
where (student_schedule.`status`=1 or student_schedule.`status`=3) and $cond and $cond1
GROUP BY classes.teacherId, student_schedule.classId, studyMonth) UNION

(select classes.teacher2Id as teacherId,concat((MONTH(student_schedule.studyDate)+1) div 2,'-', YEAR(student_schedule.studyDate)) as studyMonth, 
		classes.`name` as className, classes.amount as classAmount, teacher.name as teacherName, teacher.salary as teacherSalary, 
		student_schedule.classId, student_schedule.`status`, count(student_schedule.id) as statusCount,
		classes.amount * count(student_schedule.id) as classTotal, 
		classes.amount * count(student_schedule.id) * teacher.salary / 100 as teacherTotal,
		classes.amount * count(student_schedule.id) * (100-teacher.salary) / 100 as centerTotal,
		COUNT(DISTINCT student_schedule.studyDate) as countStudyDate, 
		COUNT(DISTINCT student_schedule.studentId) as countStudent
from student_schedule 
			inner join teacher_schedule on student_schedule.classId = teacher_schedule.classId and student_schedule.studyDate = teacher_schedule.studyDate
			inner join classes on student_schedule.classId = classes.id and teacher_schedule.teacherId = classes.teacher2Id
			INNER JOIN teacher on classes.teacher2Id = teacher.id
where (student_schedule.`status`=1 or student_schedule.`status`=3) and $cond and $cond2
GROUP BY classes.teacher2Id, student_schedule.classId, studyMonth);";
		$rows = _db()->query($query);
		$rs = array();
		foreach($rows as $row) {
			$teacher = $row['teacherName'];
			$month = $row['studyMonth'];
			$class = $row['className'];
			$rs[$teacher][$month][$class] = $row;
		}
		return $rs;
	}
}
?>