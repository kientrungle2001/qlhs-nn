<?php
$student = $data->getStudent();
$period = $data->getPeriod();
if(!$data->multiple) {
	$class = $data->getClass();
	if($class['subjectId'])
		$subject = _db()->select('*')->from('subject')->where('id='. $class['subjectId'])->result_one();
	$amount = $data->amount;
	$reason = 'Nộp tiền lớp ' . $class['name'] . ' môn ' . $subject['name'];
} else {
	$reason = 'Nộp tiền ';
	$classes = $data->getClass();
	foreach($classes as $index => $class) {
		if($class['subjectId']) {
			$subject = _db()->select('*')->from('subject')->where('id='. $class['subjectId'])->result_one();
			$classes[$index]['subject'] = $subject;
		}
		$reason .= 'lớp ' . $class['name'] . ' môn ' . $subject['name'] . ', ';
	}
	$reason .= $period['name'];
	$amounts = explode(',', $data->amounts);
	$musters = explode(',', $data->musters);
	$discounts = explode(',', $data->discounts);
	$discount_reasons = explode(',', $data->discount_reasons);
	$amount = 0;
	foreach($amounts as $a) {
		$amount += $a;
	}
}
?>
<form action="<?php echo BASE_URL; ?>/index.php/order/post" method="post">
<input type="hidden" name="multiple" value="<?php echo @$data->multiple;?>" />
<?php if($data->multiple == false) { ?>
<input type="hidden" name="classIds" value="<?php echo @$data->classId;?>" />
<input type="hidden" name="amounts" value="<?php echo @$data->amount;?>" />
<?php } else { ?>
<input type="hidden" name="classIds" value="<?php echo @$data->classIds;?>" />
<input type="hidden" name="amounts" value="<?php echo @$data->amounts;?>" />
<input type="hidden" name="musters" value="<?php echo @$data->musters;?>" />
<input type="hidden" name="discounts" value="<?php echo @$data->discounts;?>" />
<input type="hidden" name="discount_reasons" value="<?php echo @$data->discount_reasons;?>" />
<input type="hidden" name="prices" value="<?php echo @$data->prices;?>" />
<?php } ?>
<input type="hidden" name="studentId" value="<?php echo @$data->studentId;?>" />
<input type="hidden" name="payment_periodId" value="<?php echo @$data->periodId;?>" />
<div class="order_wrapper">
	<div class="order_header">
		<div class="order_company">
			<div class="order_line">
				<span class="order_line_label">Đơn vị: </span>
				<span class="order_line_value">CÔNG TY CP NEXT NOBELS</span>
			</div>
			<div class="order_line">
				<span class="order_line_label">Địa chỉ: </span>
				<span class="order_line_value">Số 6 ngõ 115 Nguyễn Khang - Cầu Giấy - Hà Nội</span>
			</div>
		</div>
		<div class="order_date">
			<div class="order_line">
				<strong class="order_line_label order_line_label_header">Phiếu Thu</strong><br />
				<span class="order_line_value">Ngày <input class="easyui-datebox" type="text" name="created" value="<?php echo date('m/d/Y', time()); ?>" /></span>
			</div>
		</div>
		<div class="order_no">
		Quyển số:<input style="width: 110px;" disabled="disabled" class="easyui-numberbox" type="text" name="bookNum" /><br />
		Số:<input class="easyui-numberbox" disabled="disabled" type="text" name="noNum"/><br />
		Nợ:<input class="easyui-numberbox" type="text" name="debit" /><br />
		Có:<input class="easyui-numberbox" type="text" name="balance" />
		</div>
		<div class="order_template">
			Mẫu số 01-TT<br />
			QĐ số: 1141-TC/QĐ/CĐKT<br />
			Ngày 1 tháng 11 năm 1995 của Bộ Tài Chính
		</div>
		<div class="clear"></div>
	</div>
	<div class="order_body">
		<div class="order_line">
			<span class="order_line_label">Họ, tên người nộp tiền: </span>
			<span class="order_line_value"><input type="hidden" name="name" value="<?php echo @$student['name'];?>" /><?php echo @$student['name'];?></span>
		</div>
		<div class="order_line">
			<span class="order_line_label">Số điện thoại: </span>
			<span class="order_line_value"><input type="hidden" name="phone" value="<?php echo @$student['phone'];?>" /><?php echo @$student['phone'];?></span>
		</div>
		<div class="order_line">
			<span class="order_line_label">Địa chỉ: </span>
			<span class="order_line_value"><input type="hidden" name="address"  value="<?php echo @$student['address'];?>" /><?php echo @$student['address'];?></span>
		</div>
		<div class="order_line">
			<span class="order_line_label">Lý do thu: </span>
			<span class="order_line_value"><input type="hidden" name="reason" value="<?php echo @$reason;?>" /><?php echo @$reason;?></span>
		</div>
		<div class="order_line">
			<table border="1" style="border-collapse: collapse; width: 100%">
				<tr>
					<td><strong>Môn học</strong></td>
					<td><strong>Lớp học</strong></td>
					<td><strong>Số <?php if($period) { ?>buổi<?php } else { ?>khóa<?php } ?></strong></td>
					<td><strong>HP/<?php if($period) { ?>buổi<?php } else { ?>khóa<?php } ?></strong></td>
					<td><strong>Thành tiền</strong></td>
					<td><strong>Trừ T.trước</strong></td>
					<td><strong>Lý do</strong></td>
					<td><strong>Tổng cộng</strong></td>
				</tr>
				<?php if($data->multiple) { ?>
				<?php foreach($classes as $i => $class) { 
				$subject = $class['subject'];
				?>
				<tr>
					<td><?php echo @$subject['name'];?></td>
					<td><?php echo @$class['name'];?></td>
					<td><?php echo $musters[$i] ?></td>
					<td><?php echo product_price($class['amount']) ?></td>
					<td><?php echo product_price($musters[$i]*$class['amount']) ?></td>
					<td><?php echo product_price($discounts[$i]) ?></td>
					<td><?php echo @$discount_reasons[$i] ?></td>
					<td><?php echo product_price($amounts[$i]) ?></td>
				</tr>
				<?php } ?>
				<?php } ?>
			</table>
		</div>
		<div class="order_line">
			<span class="order_line_label">Số tiền: </span>
			<span class="order_line_value"><input type="text" name="amount" value="<?php echo @$amount;?>" /></span>
		</div>
		<div class="order_line">
			<span class="order_line_label">Kèm theo: </span>
			<span class="order_line_value"><input type="text" name="additional" /></span>
			<span class="order_line_label">Chứng từ kế toán: </span>
			<span class="order_line_value"><input type="text" name="invoiceNum" /></span>
		</div>
	</div>
	
	<div class="order_signature_wrapper">
		<!--div class="order_date">Ngày <input class="easyui-datebox" type="text" name="created" /></div-->
		<div class="order_signature">
			<div class="order_signature_item">
				<strong>Giám đốc</strong><br />
				(Ký, họ tên, đóng dấu)<br />
				<br />
				<br />
				<br />
			</div>
			<div class="order_signature_item">
				<strong>Người nộp tiền</strong><br />
				(Ký, họ tên)
				
			</div>
			<div class="order_signature_item">
				<strong>Thủ quỹ</strong><br />
				(Ký, họ tên)<br />
				<br />
				<br />
				<br />
				Phạm Thị Phương Thu
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="order_footer"></div>
</div>
<div class="form_action">
	<input type="submit" value="Gửi" />
	<a href="<?php echo BASE_URL; ?>/index.php/student/search">Quay lại</a>
</div>
</form>