<script type="text/javascript" src="<?php echo BASE_URL;?>/lib/js/date.js"></script>
	<?php 
		$classes = $data->getClasses();
		$arrcls = array();
		foreach($classes as $class) {
			$subjectId = $class['subjectId'];
			if(!isset($arrcls[$subjectId])) {
				$arrcls[$subjectId] = array();
			}
			$arrcls[$subjectId][] = $class;
		}
	?>
<?php foreach ( $arrcls as $clss ) : ?>
<div class="easyui-tabs" style="width:1360px;height:auto;">
	<div title="Điểm danh">
		<h1><center>Điểm danh học sinh</center></h1>
	</div>
	<?php foreach ( $clss as $class ) : ?>
	<div title="<?php echo @$class['name'];?>" data-options="href:'<?php echo BASE_REQUEST . '/demo/musterTab'; ?>?classId=<?php echo @$class['id'];?>',closable:true">	
	</div>
	<?php endforeach; ?>
</div>
<?php endforeach; ?>
<strong>Lưu ý: </strong> N/A: Chưa điểm danh, CM: Có mặt, NTT: Nghỉ trừ tiền, NKT: Nghỉ không trừ tiền
<?php $data->displayChildren('all');?>
<script type="text/javascript">

function submitMuster(classId, studentId, studyDate, status) {
	$.ajax({
		type: 'post',
		method: 'post',
		url: BASE_URL + '/index.php/Dtable/replace?table=student_schedule',
		data: {classId: classId, studentId: studentId, studyDate: studyDate, status: status},
		success: function(result) {
			var result = eval('('+result+')');
			if (result.errorMsg){
				$.messager.show({
					title: 'Error',
					msg: result.errorMsg
				});
			}
		}
	});
}

function submitClassMuster(classId, studyDate, status) {
	$('.muster_' + classId + '_' + studyDate).val(status);
	$('.muster_' + classId + '_' + studyDate).change();
}

function submitTeacherMuster(classId, studyDate, teacherId) {
	$.ajax({
		type: 'post',
		method: 'post',
		url: BASE_URL + '/index.php/Dtable/replace?table=teacher_schedule',
		data: {classId: classId, teacherId: teacherId, studyDate: studyDate, status: 1},
		success: function(result) {
			var result = eval('('+result+')');
			if (result.errorMsg){
				$.messager.show({
					title: 'Error',
					msg: result.errorMsg
				});
			}
		}
	});
}

</script>