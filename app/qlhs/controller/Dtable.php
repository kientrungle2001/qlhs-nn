<?php
require_once 'core/controller/Table.php';
class PzkDtableController extends PzkTableController {
	public $tables = array(
		'class_student' => array(
			'table' 
				=> '`class_student` as c 
					inner join `student` as s on c.studentId = s.id 
					inner join `classes` as cl on c.classId = cl.id',
			
			'fields' 
				=> 'c.id, c.*, s.name as studentName, s.phone as phone, cl.name as className, 
					cl.startDate as startDate'
		),
		'classes' => array(
			'table' 
				=> '`classes` as c 
					left join `subject` as s on c.subjectId = s.id 
					left join `teacher` as t on c.teacherId = t.id
					left join `teacher` as t2 on c.teacher2Id = t2.id
					left join `room` as r on c.roomId = r.id',
			'fields' 
				=> 'c.id, c.*, s.name as subjectName, t.name as teacherName, t2.name as teacher2Name, 
					c.startDate as startDate, r.name as roomName'
		),
		
		'student' => array(
			'table' => 'student 
					left join `class_student` on student.id = class_student.studentId
					left join `classes` on class_student.classId = classes.id
					left join `student_order` on student.id = student_order.studentId
						and classes.id = student_order.classId and student_order.status=\'\' or student_order.status is null
					left join payment_period on student_order.payment_periodId = payment_period.id',
			'fields' => 'student.*, group_concat(distinct(classes.name), \' \') as classNames,
				group_concat(distinct(case when class_student.endClassDate >= CURDATE() or class_student.endClassDate=\'0000-00-00\'  then classes.name end), \' \') as currentClassNames,
				group_concat(\'[\', classes.name, \' \', case when student_order.payment_periodId = 0 then \'Cả khóa\' else payment_period.name end, \']<br />\' order by classes.name) as periodNames,
				group_concat(\'[\', payment_period.id, \']\') as periodIds',
			'groupBy' => 'student.id'
		),
		'teaching' => array(
			'table' => '`teaching` as t 
					inner join teacher as tc on t.teacherId = tc.id
					inner join subject as s on t.subjectId = s.id',
			'fields' => 't.id,t.*, tc.name as teacherName, s.name as subjectName, t.level'
		),
		'schedule' => array(
			'table' => '`schedule` as s 
					inner join classes as c on s.classId = c.id',
			'fields' => 's.id,s.*, c.name as className'
		),
		'off_schedule' => array(
			'table' => '`off_schedule` as s 
					left join classes as c on s.classId = c.id',
			'fields' => 's.id,s.*, c.name as className'
		),
		'payment_period' => array(
			'table' => '`payment_period` as p 
					left join classes as c on p.classId = c.id',
			'fields' => 'p.id,p.*, c.name as className'
		),
		'student_order' => array(
			'table' => '`student_order` as o
						left join `payment_period` as p on o.payment_periodId = p.id
						left join `student` as s on o.studentId = s.id 
						left join `classes` as c on o.classId = c.id',
			'fields' => 'o.id,o.*, c.name as className, s.name as studentName, p.name as periodName'
		),
		'general_order' => array(
			
		)
	);
	
	public $inserts = array(
		'student' => array('name', 'phone', 'school', 'birthDate', 'address', 'parentName', 
		'startStudyDate', 'endStudyDate'),
		'classes' => array('name', 'startDate', 'endDate', 'roomId', 'subjectId', 'teacherId', 'teacher2Id', 'level', 'status', 'amount'),
		'class_student' => array('classId', 'studentId', 'startClassDate', 'endClassDate'),
		'room' => array('name', 'size'),
		'subject' => array('name'),
		'teacher' => array('name', 'phone', 'address', 'school', 'salary'),
		'teaching' => array('subjectId', 'teacherId', 'level'),
		'schedule' => array('classId', 'studyDate', 'studyTime', 'status'),
		'off_schedule' => array('classId', 'offDate', 'type', 'reason', 'paymentType'),
		'payment_period' => array('classId', 'name', 'startDate', 'endDate', 'status'),
		'student_schedule' => array('classId', 'studentId', 'studyDate', 'status'),
		'teacher_schedule' => array('classId', 'teacherId', 'studyDate', 'status'),
		'student_order' => array('classId', 'studentId', 'payment_periodId', 'amount'),
		'profile_controller_permission' => array('type', 'controller', 'action', 'status'),
		'profile_profile' => array('username', 'password', 'type', 'fullName'),
		'profile_type' => array('name')
	);
	
	public $filters = array(
		'student' => array(
			'none' => 0
		),
		'student_order' => array(
			'classId' => array('=' => 'o`.`classId')
		),
		'class_student' => array(
			'studentName' => array(
				'like' => 's`.`name'
			)
		),
		'student_filter' => array(
			'where' => array(
				'name' => array('like', array('column', 'student', 'name'), '%?%'),
				'phone' => array('like', array('column', 'student', 'phone'), '%?%')
			),
			'having' => array(
				'classNames' => array('like', array('column', 'currentClassNames'), '%?%'),
				//'periodId' => array('like', array('column', 'periodIds'), '%?%'),
				'periodId' => array('sql', 'count(if(payment_period.id=?, 1, null)) = count(distinct(if(
				(class_student.startClassDate = \'0000-00-00\' or class_student.startClassDate < (select endDate from payment_period where id=?))
				and
				(class_student.endClassDate = \'0000-00-00\' or class_student.endClassDate > (select startDate from payment_period where id=?))
				and 
				classes.name not like \'%M%\', classes.id, null)))'),
				'notlikeperiodId' => array('or',
					array('isnull', array('column', 'periodIds')),
					array('sql', 'count(if(payment_period.id=?, 1, null)) < count(distinct(if(
				(class_student.startClassDate = \'0000-00-00\' or class_student.startClassDate < (select endDate from payment_period where id=?))
				and
				(class_student.endClassDate = \'0000-00-00\' or class_student.endClassDate > (select startDate from payment_period where id=?))
				and 
				classes.name not like \'%M%\', classes.id, null)))')
				)
			)
		)
	);
	
	public $constraints = array(
		'class_student' => array('unique_key' => array('type' => 'key', 'key' 
				=> array('classId', 'studentId'), 'message' => 'Bản ghi đã tồn tại' )),
		'student' => array('unique_key' => array('type' => 'key', 'key' 
				=> array('name', 'phone'), 'message' => 'Bản ghi đã tồn tại' )),
		'student_schedule' => array('unique_key' => array('type' => 'key', 'key' 
				=> array('classId', 'studentId', 'studyDate'), 'message' => 'Bản ghi đã tồn tại' )),
		'teacher_schedule' => array('unique_key' => array('type' => 'key', 'key' 
				=> array('classId',  'studyDate'), 'message' => 'Bản ghi đã tồn tại' )),
		'profile_controller_permission' => array('unique_key' => array('type' => 'key', 'key' 
				=> array('type',  'controller', 'action'), 'message' => 'Bản ghi đã tồn tại' ))
				
	);
	
	public $deletes = array(
		'general_order' => array('student_order' => 'orderId'),
		'billing_order' => array('billing_detail_order' => 'orderId'),
	);
	public $statusDeletes = array('general_order' => true);
	
	public function addscheduleAction() {
		$startTime = $this->_getTime($_REQUEST['startDate']);
		$endTime = $this->_getTime($_REQUEST['endDate']);
		$datas = array();
		for($time = $startTime; $time <= $endTime; $time += 24 * 3600) {
			if(date('w', $time) == $_REQUEST['weekday']) {
				$data = array(
					'classId' => $_REQUEST['classId'],
					'studyTime' => $_REQUEST['studyTime'],
					'studyDate' => date('Y-m-d', $time),
					'status' => '1'
				);
				$datas[] = $data;
			}
		}
		$fields = array('classId', 'studyTime', 'studyDate', 'status');
		_db()->insert('schedule')
				->fields(implode(',', $fields))
				->values($datas)->result();
		echo json_encode(array(
			'errorMsg' => false,
			'success' => true,
			'data' => json_encode($datas)
		));
	}
	
	public function _getTime($date) {
		return strtotime($date);
		$parts = explode('-', $date);
		$newDate = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
		return strtotime($newDate);
	}
	
	public function studentschedulepostAction() {
		$muster = @$_REQUEST['muster'];
		if(!$muster) {
			echo json_encode(array(
				'errorMsg' => 'Bạn chưa post lên điểm danh nào',
				'success' => true,
				'data' => false
			));
			return false;
		}
		foreach($muster as $classId => $students) {
			foreach($students as $studentId => $dates) {
				foreach($dates as $date => $status) {
					if ($items = _db()->select('*')
							->from('student_schedule')
							->where("classId=$classId and studentId=$studentId and studyDate='$date'")->result()) {
						$item = $items[0];
						_db()->update('student_schedule')
						->set(array(
								'classId' => $classId,
								'studentId' => $studentId,
								'studyDate' => $date,
								'status' => $status
							))->where('id=' . $item['id'])->result();
					} else {
						_db()->insert('student_schedule')
							->fields('classId,studentId,studyDate,status')
							->values(array(array(
								'classId' => $classId,
								'studentId' => $studentId,
								'studyDate' => $date,
								'status' => $status
							)))->result();
					}
				}
			}
		}
		echo json_encode(array(
			'errorMsg' => 'Cập nhật thành công',
			'success' => true,
			'data' => $muster
		));
	}
}