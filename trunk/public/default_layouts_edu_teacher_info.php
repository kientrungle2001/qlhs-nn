<?php
$teacher = _db()->getEntity('edu.teacher')->load(pzk_session('teacherId'));
$classes = $teacher->getClasses();
?>
<a href="<?php echo BASE_REQUEST . '/teacher/changePassword'; ?>">Đổi mật khẩu</a>
<h2>Giáo viên - <?php echo $teacher->getName(); ?></h2>
<hr />
<div class="easyui-tabs">
<?php foreach ( $classes as $class ) : ?>
<?php if($class->getSubjectId()==3) { ?>

<div title="Lớp <?php echo $class->getName(); ?>" class="padding10">
	<?php $periods = $class->getPeriods(); ?>
	<h2>Nhận xét của giáo viên</h2>
	<table class="table" border="1" style="border-collapse: collapse">
	<tr>
		<th>Học sinh</th>
		<?php for ($i = 1; $i < 17; $i++) { ?>
		<th>Buổi <?php echo @$i;?></th>
		<?php } ?>
		<th>Ghi chú</th>
	</tr>
	<?php $students = $class->getStudents(); 
	
	$index = 1; ?>
	<?php foreach ( $students as $student ) : ?>
	<?php $studyDates = $student->getStudyDates(); ?>
	<tr>
	<th><?php echo @$index;?>. <?php echo $student->getName();?></th>
	
	<?php foreach ( $studyDates as $studyDate ) : ?>
		<td style="padding: 0;">
			<input type="text" 
			onchange="updatePeriodMark(<?php echo $class->getId(); ?>, <?php echo $student->getId(); ?>, <?php echo $studyDate->getPeriodId(); ?>, $(this).val())"
			value="<?php echo $studyDate->getMarks(); ?>" style="width: 40px" />
		</td>
	<?php endforeach; ?>
	<td>
	<textarea style="width: 300px"
		onchange="updateStudentNote($(this).val(), <?php echo $student->getClassStudentId(); ?>)"><?php echo $student->getNote();?></textarea>
	</td>
	</tr>
	<?php $index++; ?>
	<?php endforeach; ?>
	</table>
</div>
<?php } else { ?>
<div title="Lớp <?php echo $class->getName(); ?>" class="padding10">
	<?php $periods = $class->getPeriods(); ?>
	<h2>Nhận xét của giáo viên</h2>
	<table class="table" border="1" style="border-collapse: collapse">
	<tr>
		<th>Học sinh</th>
		<th>Ghi chú</th>
	</tr>
	<?php $students = $class->getStudents(); 
	
	$index = 1; ?>
	<?php foreach ( $students as $student ) : ?>
	<?php $periods = $student->getPeriods(); ?>
	<tr>
	<th><?php echo @$index;?>. <?php echo $student->getName();?></th>
	<td>
	<textarea style="width: 300px"
		onchange="updateStudentNote($(this).val(), <?php echo $student->getClassStudentId(); ?>)"><?php echo $student->getNote();?></textarea>
	</td>
	
	</tr>
	<?php foreach ( $periods as $period ) : ?>
		<tr>
			<td><?php echo $period->getName(); ?></td>
			<td>
			Điểm<br />
			<input type="text" 
			onchange="updatePeriodMark(<?php echo $class->getId(); ?>, <?php echo $student->getId(); ?>, <?php echo $period->getId(); ?>, $(this).val())"
			value="<?php echo $period->getMarks(); ?>" style="width: 80px" />
			<br />Nhận xét theo kỳ<br />
			<textarea style="width: 300px"
				onchange="updatePeriodNote(<?php echo $class->getId(); ?>, <?php echo $student->getId(); ?>, <?php echo $period->getId(); ?>, $(this).val())"><?php echo $period->getNote();?></textarea>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php $index++; ?>
	<?php endforeach; ?>
	</table>
</div>
<?php } ?>
<?php endforeach; ?>
</div>
<script>
function updateStudentNote(note, classStudentId) {
	$.ajax({
		type: 'post',
		url: '<?php echo BASE_REQUEST . '/dtable/update'; ?>?table=class_student&noConstraint=1',
		data: {
			id: classStudentId,
			note: note
		},
		success: function(resp) {
			resp = eval('(' + resp + ')');
			if(resp.success) {
				
			}
		}
	});
}
function updatePeriodMark(classId, studentId, periodId, marks) {
	$.ajax({
		type: 'post',
		url: '<?php echo BASE_REQUEST . '/dtable/replace'; ?>?table=class_student_period_mark',
		data: {
			classId: classId,
			studentId: studentId,
			periodId: periodId,
			marks: marks
		},
		success: function(resp) {
			resp = eval('(' + resp + ')');
			if(resp.success) {
				
			}
		}
	});
}
function updatePeriodNote(classId, studentId, periodId, note) {
	$.ajax({
		type: 'post',
		url: '<?php echo BASE_REQUEST . '/dtable/replace'; ?>?table=class_student_period_mark',
		data: {
			classId: classId,
			studentId: studentId,
			periodId: periodId,
			note: note
		},
		success: function(resp) {
			resp = eval('(' + resp + ')');
			if(resp.success) {
				
			}
		}
	});
}
</script>
<style>
.padding10 {
	padding: 10px;
}
.table {
	width: 75%;
}
.table tr td, .table tr th{
	padding: 10px;
}
</style>