﻿	<?php 
	$class = $data->getClass();
	$dates = $data->getStudyDates($class['id']);
	$students = $data->getStudents($class['id']);
	$period = $data->getPeriod();
	?>
		<div title="<?php echo @$period['name'];?>">
			
			<h3 style="text-align: left; margin-left: 20px;">Danh sách lớp <?php echo @$class['name'];?></h3>
			<table border="1" cellpadding="4px" cellspacing="0" style="border-collapse:collapse;margin: 15px;">
				<tr>
					<th>STT</th>
					<th>Họ và tên</th>
					<th>Số điện thoại</th>
					<?php foreach ( $dates as $date ) : ?>
					<?php if ($date['studyDate'] >= $period['startDate'] && $date['studyDate'] < $period['endDate']) { ?>
					<th><?php echo date('d/m', strtotime($date['studyDate']))?></th>
					<?php } ?>
					<?php endforeach; ?>
				</tr>
				<?php $index = 0; ?>
				<?php foreach ( $students as $student ) : ?>
				<?php if ($student['endStudyDate'] !== '0000-00-00' && $student['endStudyDate'] < $period['startDate']) { continue; } ?>
				<?php if ($student['startStudyDate'] !== '0000-00-00' && $student['startStudyDate'] > $period['endDate']) { continue; } ?>
				<?php if ($student['endClassDate'] !== '0000-00-00' && $student['endClassDate'] < $period['startDate']) { continue; } ?>
				<?php if ($student['startClassDate'] !== '0000-00-00' && $student['startClassDate'] > $period['endDate']) { continue; } ?>
				<?php $index++; ?>
				<tr>
					<td><?php echo @$index;?></td>
					<td><?php echo @$student['name'];?></td>
					<td><?php echo @$student['phone'];?></td>
					<?php foreach ( $dates as $date ) : ?>
					
					<?php if ($date['studyDate'] >= $period['startDate'] && $date['studyDate'] < $period['endDate']) { ?>
					<?php if ($student['startStudyDate'] == '0000-00-00' || $student['startStudyDate'] <= $date['studyDate']) { ?>
					<?php if ($student['endStudyDate'] == '0000-00-00' || $student['endStudyDate'] > $date['studyDate']) { ?>
					<?php if ($student['startClassDate'] == '0000-00-00' || $student['startClassDate'] <= $date['studyDate']) { ?>
					<?php if ($student['endClassDate'] == '0000-00-00' || $student['endClassDate'] > $date['studyDate']) { ?>
					<td>&nbsp;
					</td>
					<?php } ?>
					<?php } ?>
					<?php } ?>
					<?php } ?>
					<?php } ?>
					<?php endforeach; ?>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>