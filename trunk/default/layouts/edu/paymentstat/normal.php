
<div class="easyui-tabs" style="width:1100px;height:auto;padding: 5px;">
{?
	$class = $data->getClass();
	
	$class->makePaymentStats();
	$class->makeTeacherStats();
	
	$teacher = $class->getTeacher();
	$teacher2 = $class->getTeacher2();
	
	$periods = $class->getPeriods();
	$students = $class->getRawStudents();
	
	// hien thi bang thanh toan
	$periodCount = count($periods);
	$periodIndex = 0;
?}
	{each $periods as $period}
	{? 	$payment = $period->getStudentIdPaids($class, $students); $periodIndex++; ?}
	<div title="{? echo $period->getName()?}" {? if($periodCount==$periodIndex) { echo 'data-options="selected: true"'; } ?}>
	<a href="{url /demo/paymentstatPrint}?classId={? echo $class->getId() ?}&periodId={? echo $period->getId()?}" target="_blank">Xem bản in</a>
	<table border="1" cellpadding="4px" cellspacing="0" style="border-collapse:collapse;margin: 15px;width: 1000px;">
		<tr>
			<th colspan="14">{? echo $period->getName()?}</th>
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
	{? 	$stds = $period->getStudentStats(); $stdIndex = 0;
		if($stds) foreach($stds as $studentId => $stdStat) {  $student = $students[$studentId]; $stdIndex++; ?}
		<tr>
			<th>{stdIndex}. {? echo $student->getName() ?}</th>
			<th>{? echo $student->getPhone() ?}</th>
			<th>{stdStat[0]}</th>
			<th>{stdStat[1]}</th>
			<th>{stdStat[2]}</th>
			<th>{stdStat[3]}</th>
			<th>{stdStat[4]}</th>
			<th>{stdStat[5]}</th>
			<th>{stdStat[6]}</th>
			<th>{stdStat[total]}</th>
			<th>{? echo product_price($period->getAmountOfClass($class)); ?}</th>
			<th>{stdStat[sobuoihoc]}</th>
			<th>{? echo product_price($stdStat['hocphi'])?}</th>
			<th>{? echo $payment->getStatus($student); ?}</th>
		</tr>
	{? 	} ?}
		<tr>
			<td colspan="14">
				Sĩ số: {stdIndex}<br />
				Đã thanh toán : {? echo $payment->getNumberOfPaids(); ?}<br />
				Chưa thanh toán : {? echo $payment->getNumberOfNonPaids(); ?}<br />
			</td>
		</tr>
	</table>
	
	<table border="1" cellpadding="4px" cellspacing="0" style="border-collapse:collapse;margin: 15px;width: 1000px;">
		<tr>
			<th>Thống kê</th>
			<th>Giáo viên 1</th>
			<th>Giáo viên 2</th>
		</tr>
		<tr>
			<th>Họ và tên</th>
			<td>{? if($teacher) { echo $teacher->getName(); } ?}</td>
			<td>{? if($teacher2) { echo $teacher2->getName(); } ?}</td>
		</tr>
		<tr>
			<th>Số buổi dạy</th>
			<td>{? echo $period->getStatOfTeacher($teacher);?}</td>
			<td>{? echo $period->getStatOfTeacher($teacher2);?}</td>
		</tr>
	</table>
	</div>
	{/each}
</div>