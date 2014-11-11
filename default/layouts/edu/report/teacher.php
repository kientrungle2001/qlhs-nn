<?php
$summary = $data->getSummary();
?>
<?php foreach($summary as $teacherName => $teacherData) { ?>
<h2>Báo cáo doanh thu theo giáo viên {teacherName}</h2>
<table border="1px" style="width: 1024px; border: 1px solid black; border-collapse: collapse;">
	<tr>
		<td>Kỳ</td>
		<?php foreach($teacherData as $periodName => $periodData) { ?>
		<td colspan="<?php echo count(array_keys($periodData))+1?>">{periodName}</td>
		<?php } ?>
		<td rowspan="2">Tổng kết</td>
	</tr>
	<tr>
		<td>Lớp</td>
		<?php foreach($teacherData as $periodName => $periodData) { ?>
			<?php foreach($periodData as $className => $classData) { ?>
				<td>{className}</td>
			<?php } ?>
			<td>Tổng kỳ</td>
		<?php } ?>
		<!--td>Tổng kết</td-->
	</tr>
	<tr>
		<td>Số buổi dạy</td>
		<?php 
		$total = 0;
		foreach($teacherData as $periodName => $periodData) { 
			$subTotal = 0;?>
			<?php foreach($periodData as $className => $classData) { 
				$subTotal += $classData['countStudyDate'];
				?>
				<td>{classData[countStudyDate]}</td>
			<?php } 
			$total += $subTotal;
			?>
			<td>{subTotal}</td>
		<?php } ?>
		<td>{total}</td>
	</tr>
	<tr>
		<td>Số học sinh</td>
		<?php 
		$total = 0;
		foreach($teacherData as $periodName => $periodData) { 
			$subTotal = 0;
		?>
			<?php foreach($periodData as $className => $classData) { 
				$subTotal += $classData['countStudent'];
			?>
				<td>{classData[countStudent]}</td>
			<?php } 
			$total += $subTotal;
			?>
			<td>{subTotal}</td>
		<?php } ?>
		<td>{total}</td>
	</tr>
	<tr>
		<td>Số lần HS đi học</td>
		<?php 
		$total = 0;
		foreach($teacherData as $periodName => $periodData) { 
			$subTotal = 0;
		?>
			<?php foreach($periodData as $className => $classData) { 
				$subTotal += $classData['statusCount'];
			?>
				<td>{classData[statusCount]}</td>
			<?php } 
				$total += $subTotal;
			?>
			<td>{subTotal}</td>
		<?php } ?>
		<td>{total}</td>
	</tr>
	<tr>
		<td>Doanh thu</td>
		<?php 
		$total = 0;
		foreach($teacherData as $periodName => $periodData) { 
			$subTotal = 0;
		?>
			<?php foreach($periodData as $className => $classData) { 
				$subTotal += $classData['classTotal'];
				?>
				<td>{? echo product_price( $classData['classTotal'] ) ?}</td>
			<?php }
			$total += $subTotal;
			?>
			<td>{? echo product_price($subTotal) ?}</td>
		<?php } ?>
		<td>{? echo product_price($total) ?}</td>
	</tr>
	<tr>
		<td>Trả lương</td>
		<?php 
		$total = 0;
		foreach($teacherData as $periodName => $periodData) { 
		$subTotal = 0;
		?>
			<?php foreach($periodData as $className => $classData) { 
			$subTotal += $classData['teacherTotal'];
			?>
				<td>{? echo product_price($classData['teacherTotal']) ?}</td>
			<?php } 
			$total += $subTotal;
			?>
			<td>{? echo product_price($subTotal) ?}</td>
		<?php } ?>
		<td>{? echo product_price($total) ?}</td>
	</tr>
	<tr>
		<td>Doanh thu trung tâm</td>
		<?php 
		$total = 0;
		foreach($teacherData as $periodName => $periodData) { 
		$subTotal = 0;
		?>
			<?php foreach($periodData as $className => $classData) { 
			$subTotal += $classData['centerTotal'];
			?>
				<td>{? echo product_price( $classData['centerTotal']) ?}</td>
			<?php } 
			$total += $subTotal;
			?>
			<td>{? echo product_price($subTotal) ?}</td>
		<?php } ?>
		<td>{? echo product_price($total) ?}</td>
	</tr>
</table>
<?php } ?>