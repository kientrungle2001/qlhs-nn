<?php
$student = _db()->getEntity('edu.student')->load(pzk_session('studentId'));
$classes = $student->getClasses();
?>
<h2>Thông tin học sinh - <?php echo $student->getName(); ?></h2>
<hr />
<div class="easyui-tabs">
<?php foreach ( $classes as $class ) : ?>
<?php if($class->getSubjectId()==3) { ?>
<div title="Lớp <?php echo $class->getName(); ?>" class="padding10">
<h2>Nhận xét của giáo viên</h2>
<p><?php echo nl2br($class->getNote()); ?></p>
<?php
$studentsInClass = $class->getStudents('student.name', $student->getId());
if($studentsInClass) {
	$studentInClass = $studentsInClass[0];
}
$studyDates = $studentInClass->getStudyDates();
?>
<h2>Điểm số</h2>
<table class="table" border="1" style="border-collapse: collapse;">
<tr>
	<th title="Buổi" style="width: 150px;">Buổi</th>
	<th title="Điểm" style="width: 80px;">Điểm</th>
	<th title="Nhận xét">Nhận xét</th>
</tr>
<?php $first = false; ?>
<?php foreach ( $studyDates as $studyDate ) : ?>
<tr>
	<td title="<?php echo $studyDate->getPeriodId(); ?>">Buổi <?php echo ($studyDate->getPeriodId()); ?></td>
	<td title="<?php echo $studyDate->getPeriodId(); ?>"><?php echo $studyDate->getMarks(); ?>&nbsp;</td>
	<?php if (!$first) { ?>
	<td rowspan="16" valign="top"><?php echo $studentInClass->getNote(); ?></td>
	<?php 
			$first = true;
		} ?>
</tr>
<?php endforeach; ?>

</table>
</div>
<?php } else { ?>
<div title="Lớp <?php echo $class->getName(); ?>" class="padding10">
<h2>Nhận xét của giáo viên</h2>
<p><?php echo nl2br($class->getNote()); ?></p>
<?php
$studentsInClass = $class->getStudents('student.name', $student->getId());
if($studentsInClass) {
	$studentInClass = $studentsInClass[0];
}
$periods = $studentInClass->getPeriods();
?>
<h2>Điểm số</h2>
<table class="table" border="1" style="border-collapse: collapse;">
<tr>
	<th title="Kỳ học" style="width: 150px;">Kỳ học</th>
	<th title="Điểm" style="width: 80px;">Điểm</th>
	<th title="Nhận xét">Nhận xét</th>
</tr>
<?php foreach ( $periods as $period ) : ?>
<tr>
	<td title="<?php echo $period->getName(); ?>"><?php echo $period->getName(); ?></td>
	<td title="<?php echo $period->getName(); ?>"><?php echo $period->getMarks(); ?>&nbsp;</td>
	<td title="Nhận xét" valign="top"><?php echo $period->getNote(); ?></td>
</tr>
<?php endforeach; ?>

</table>
</div>

<?php } ?>
<?php endforeach; ?>
</div>
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