<?php
$class = $data->getClass();
?>
<!-- truong hop lop van mieu ta -->
<?php if($class['subjectId'] == 3) {
		$students = $data->getStudents();
		// danh sách học sinh đã thanh toán
		$orders = _db()->useCB()->select('studentId')->from('student_order')
			->where(array('and', array('classId', $class['id']), array('status', '')))->result();
		$payments = array();
		foreach($orders as $order) {
			$payments[$order['studentId']] = true;
		}
	?>
	<a href="<?php echo BASE_REQUEST . '/demo/paymentstatPrint'; ?>?classId=<?php echo @$class['id'];?>&periodId=0" target="_blank">Xem bản in</a>
	
	<table border="1" cellpadding="4px" cellspacing="0" style="border-collapse:collapse;margin: 15px;width: 1000px;">
		<tr>
			<th colspan="9"><?php echo @$class['name'];?></th>
		</tr>
		<tr>
			<th>Họ tên</th>
			<th>Số điện thoại</th>
			<th>Học phí</th>
			<th>Trạng thái</th>
			
		</tr>
		<?php 
			$index = 0;
			$numberPaid = 0;
			$numberNonPaid = 0;
		?>
		<?php foreach ( $students as $student ) : ?>	
		<?php $index++; ?>
		<?php 
			// xet xem da thanh toan hay chua
			$status = '';
			if(@$payments[$student['id']]) { 
				$status = '<span style="color: green;">Đã thanh toán</span>'; 
				$numberPaid++;
			} else { 
				$status = '<span style="color: red;">Chưa thanh toán</span>'; 
				$numberNonPaid++;
			} ?>
		<tr>
			<td><?php echo @$index;?>. <?php echo @$student['name'];?></td>
			<td><?php echo @$student['phone'];?></td>
			<td><?php echo product_price($class['amount']) ?></td>
			<td><?php echo @$status;?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<table>
	<tr><td>Sĩ số:</td><td> <?php echo @$index;?> học sinh</td></tr>
	<tr><td>Đã thanh toán:</td><td> <?php echo @$numberPaid;?> học sinh</td></tr>
	<tr><td>Chưa thanh toán:</td><td> <?php echo @$numberNonPaid;?> học sinh</td></tr>
	</table>
<?php } else { ?>
<div class="easyui-accordion" style="width:1100px;height:auto;padding: 5px;">
<?php
	// loc ra cac ky hoc cua lop
	$conds = array('and');
	if($class['startDate'] !== '0000-00-00') {
		$conds[] = array('or', array('gte', 'startDate', $class['startDate']), array('gt', 'endDate', $class['startDate']));
	}
	if($class['endDate'] !== '0000-00-00') {
		$conds[] = array('or', array('lte', 'startDate', $class['endDate']), array('lt', 'endDate', $class['endDate']));
	}
	$conds[] = array('status', '1');
	$periods = _db()->useCB()->select('*')->from('payment_period')
		->where($conds)->orderBy('startDate asc')->result();
	$periodByIds = array();
	foreach($periods as $period) {
		$periodByIds[$period['id']] = $period;
	}
	// lay danh sach hoc sinh
	$students = $data->getStudents();
	
	// lay lich hoc cua lop trong cac ky
	$scheduleConds = array('and');
	$scheduleConds[] = array('equal', 'classId', $class['id']);
	$scheduleConds[] = array('gte', 'studyDate', min_array($periods, 'startDate'));
	$scheduleConds[] = array('lt', 'studyDate', max_array($periods, 'endDate'));
	$schedules = _db()->useCB()->select('studyDate')->from('schedule')->where($scheduleConds)->orderBy('studyDate asc')->result();
	
	// chia lich hoc theo cac ky
	$periodSchedules = array();
	foreach($periods as $period) {
		$periodSchedules[$period['id']] = array();
	}
	foreach($schedules as $schedule) {
		foreach($periods as $period) {
			if($schedule['studyDate'] >= $period['startDate'] &&  $schedule['studyDate'] < $period['endDate']) {
				$periodSchedules[$period['id']][] = $schedule['studyDate'];
			}
		}
	}
	
	// duyet qua cac ky
		// duyet qua cac hoc sinh
			// dua ra cac buoi hoc cua hoc sinh
	$periodStudentSchedules = array();
	foreach($periods as $period) {
		$periodStudentSchedules[$period['id']] = array();
		foreach($students as $student) {
			$studentScheduleDateCount = 0;
			foreach($periodSchedules[$period['id']] as $studyDate) {
				if(($student['startClassDate']==='0000-00-00' or $studyDate >= $student['startClassDate'])
					and
					($student['endClassDate']==='0000-00-00' or $studyDate < $student['endClassDate'])) {
						if($studentScheduleDateCount == 0) {
							$periodStudentSchedules[$period['id']][$student['id']] = array();
						}
						$studentScheduleDateCount++;
						$periodStudentSchedules[$period['id']][$student['id']][$studyDate] = '0';
				}
			}
		}
	}
	
	// danh dau cac trang thai diem danh
	$studentScheduleConds = array('and');
	$studentScheduleConds[] = array('equal', 'classId', $class['id']);
	$studentScheduleConds[] = array('gte', 'studyDate', min_array($periods, 'startDate'));
	$studentScheduleConds[] = array('lt', 'studyDate', max_array($periods, 'endDate'));
	$studentSchedules = _db()->useCB()->select('studentId, studyDate, status')->from('student_schedule')->where($studentScheduleConds)->orderBy('studentId asc, studyDate asc')->result();
	
	foreach($studentSchedules as $studentSchedule){
		foreach($periods as $period) {
			if(isset($periodStudentSchedules[$period['id']][$studentSchedule['studentId']][$studentSchedule['studyDate']])) {
				$periodStudentSchedules[$period['id']][$studentSchedule['studentId']][$studentSchedule['studyDate']] = $studentSchedule['status'];
			}
		}
	}
	
	// lich nghi
	$offScheduleConds = array('and');
	$offScheduleConds[] = array(
		'or', 
		array(
			'and', 
			array('equal', 'classId', $class['id']),
			array('equal', 'type', 'class')
		),
		array('equal', 'type', 'center')
	);
	$offScheduleConds[] = array('gte', 'offDate', min_array($periods, 'startDate'));
	$offScheduleConds[] = array('lt', 'offDate', max_array($periods, 'endDate'));
	
	$scheduleDates = array();
	foreach($schedules as $schedule) {
		$scheduleDates[] = "'{$schedule['studyDate']}'";
	}
	$offScheduleConds[] = array('in', 'offDate', $scheduleDates);
	$offSchedules = _db()->useCB()->select('*')->from('off_schedule')->where($offScheduleConds)->orderBy('offDate asc');
	$offSchedules = $offSchedules->result();
	
	// duyet qua cac lich nghi
	foreach($periods as $period) {
		foreach($offSchedules as $offSchedule) {
			if($offSchedule['offDate'] >= $period['startDate'] && $offSchedule['offDate'] < $period['endDate']) {
				foreach($students as $student) {
					if(isset($periodStudentSchedules[$period['id']][$student['id']][$offSchedule['offDate']])){
						$periodStudentSchedules[$period['id']][$student['id']][$offSchedule['offDate']] = ($offSchedule['paymentType'] == 'immediate') ? '4' : '2';
					}
				}
			}
		}
	}
	
	// bat dau tinh so buoi hoc
	$periodStudentStats = array(); 
	$lastPeriodId = null; // ki thanh toan truoc
	foreach($periodStudentSchedules as $periodId => $stds) {
		foreach($stds as $studentId => $scheduleDates) {
			$statuses = array_values($scheduleDates);
			for($i = 0; $i < 6; $i++) {
				$periodStudentStats[$periodId][$studentId][$i] = count_array($statuses, $i);
			}
			// so buoi nghi tru tien thang truoc
			if($lastPeriodId) {
				$periodStudentStats[$periodId][$studentId][6] = @$periodStudentStats[$lastPeriodId][$studentId][2];
			}
			$periodStudentStats[$periodId][$studentId]['total'] = count($statuses);
			$periodStudentStats[$periodId][$studentId]['sobuoihoc'] = $periodStudentStats[$periodId][$studentId]['total'] - @$periodStudentStats[$periodId][$studentId]['4'] - @$periodStudentStats[$periodId][$studentId]['6'];
			$periodStudentStats[$periodId][$studentId]['hocphi'] = $class['amount'] * $periodStudentStats[$periodId][$studentId]['sobuoihoc'];
		}
		$lastPeriodId = $periodId;
	}
	
	// xem danh sach hoa don
	$orderConds = array('and', 
		array('classId', $class['id']), 
		array('in','payment_periodId', array_keys($periodByIds)),
		array('in', 'studentId', array_keys($students))
	);
	$orders = _db()->useCB()->select('id, orderId, payment_periodId as periodId, studentId')->from('student_order')->where($orderConds)->result();
	
	// tinh xem hoc sinh da thanh toan hoc phi chua
	foreach($orders as $order) {
		$periodId = $order['periodId'];
		$studentId = $order['studentId'];
		if(isset($periodStudentStats[$periodId][$studentId])) {
			$periodStudentStats[$periodId][$studentId]['orderId'] = $order['orderId'];
		}
	}
	
	// hien thi bang thanh toan
	foreach($periodStudentStats as $periodId => $stds) { 
	$period = $periodByIds[$periodId];
	?>
	<div title="<?php echo @$period['name'];?>">
	<a href="<?php echo BASE_REQUEST . '/demo/paymentstatPrint'; ?>?classId=<?php echo @$class['id'];?>&periodId=<?php echo @$period['id'];?>" target="_blank">Xem bản in</a>
	<table border="1" cellpadding="4px" cellspacing="0" style="border-collapse:collapse;margin: 15px;width: 1000px;">
		<tr>
			<th colspan="14"><?php echo @$period['name'];?></th>
		</tr>
		<tr>
			<th>Họ tên</th>
			<th>Số điện thoại</th>
			<th>N/A</th>
			<th>CM</th>
			<th>NTT</th>
			<th>NKT</th>
			<th>KTT</th>
			<th>DH</th>
			<th>NLM</th>
			<th>Tổng</th>
			<th>Học phí</th>
			<th>Số buổi</th>
			<th>Thành tiền</th>
			<th>Trạng thái</th>
		</tr>
<?php
		$stdIndex = 0;
		$numberPaid = 0;
		$numberNonPaid = 0;
		foreach($stds as $studentId => $stdStat) { 
			$student = $students[$studentId];
			$stdIndex++;
			if(isset($stdStat['orderId'])) {
				$numberPaid++;
				$status = '<span style="color: green;">Đã thanh toán</span>';
			} else {
				$numberNonPaid++;
				$status = '<span style="color: red;">Chưa thanh toán</span>';
			}
			
		?>
		<tr>
			<th><?php echo @$stdIndex;?>. <?php echo @$student['name'];?></th>
			<th><?php echo @$student['phone'];?></th>
			<th><?php echo @$stdStat['0'];?></th>
			<th><?php echo @$stdStat['1'];?></th>
			<th><?php echo @$stdStat['2'];?></th>
			<th><?php echo @$stdStat['3'];?></th>
			<th><?php echo @$stdStat['4'];?></th>
			<th><?php echo @$stdStat['5'];?></th>
			<th><?php echo @$stdStat['6'];?></th>
			<th><?php echo @$stdStat['total'];?></th>
			<th><?php echo product_price($class['amount']); ?></th>
			<th><?php echo @$stdStat['sobuoihoc'];?></th>
			<th><?php echo product_price($stdStat['hocphi'])?></th>
			<th><?php echo @$status;?></th>
		</tr>
<?php
		} ?>
		<tr>
			<td colspan="14">
				Sĩ số: <?php echo @$stdIndex;?><br />
				Đã thanh toán : <?php echo @$numberPaid;?><br />
				Chưa thanh toán : <?php echo @$numberNonPaid;?><br />
			</td>
		</tr>
	</table>
	</div>
<?php
	}
?>
</div>
<?php } ?>