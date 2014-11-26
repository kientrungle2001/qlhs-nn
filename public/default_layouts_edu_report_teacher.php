<?php
$summary = $data->getSummary();
?>
<?php foreach($summary as $teacherName => $teacherData) { ?>
<h2>Báo cáo doanh thu theo giáo viên <?php echo @$teacherName;?></h2>
<table border="1px" style="width: 1024px; border: 1px solid black; border-collapse: collapse;">
	<tr>
		<td>Kỳ</td>
		<?php foreach($teacherData as $periodName => $periodData) { ?>
		<td colspan="<?php echo count(array_keys($periodData))+1?>"><?php echo @$periodName;?></td>
		<?php } ?>
		<td rowspan="2">Tổng kết</td>
	</tr>
	<tr>
		<td>Lớp</td>
		<?php foreach($teacherData as $periodName => $periodData) { ?>
			<?php foreach($periodData as $className => $classData) { ?>
				<td><?php echo @$className;?></td>
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
				<td><?php echo @$classData['countStudyDate'];?></td>
			<?php } 
			$total += $subTotal;
			?>
			<td><?php echo @$subTotal;?></td>
		<?php } ?>
		<td><?php echo @$total;?></td>
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
				<td><?php echo @$classData['countStudent'];?></td>
			<?php } 
			$total += $subTotal;
			?>
			<td><?php echo @$subTotal;?></td>
		<?php } ?>
		<td><?php echo @$total;?></td>
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
				<td><?php echo @$classData['statusCount'];?></td>
			<?php } 
				$total += $subTotal;
			?>
			<td><?php echo @$subTotal;?></td>
		<?php } ?>
		<td><?php echo @$total;?></td>
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
				<td><?php echo product_price( $classData['classTotal'] ) ?></td>
			<?php }
			$total += $subTotal;
			?>
			<td><?php echo product_price($subTotal) ?></td>
		<?php } ?>
		<td><?php echo product_price($total) ?></td>
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
				<td><?php echo product_price($classData['teacherTotal']) ?></td>
			<?php } 
			$total += $subTotal;
			?>
			<td><?php echo product_price($subTotal) ?></td>
		<?php } ?>
		<td><?php echo product_price($total) ?></td>
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
				<td><?php echo product_price( $classData['centerTotal']) ?></td>
			<?php } 
			$total += $subTotal;
			?>
			<td><?php echo product_price($subTotal) ?></td>
		<?php } ?>
		<td><?php echo product_price($total) ?></td>
	</tr>
</table>
<?php } ?>