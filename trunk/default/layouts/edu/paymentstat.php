<script type="text/javascript" src="/lib/js/date.js"></script>
	{?
		$classes = $data->getClasses();
		$orders = $data->getStructureOrders();
		$periods = $data->getPaymentPeriods(0);
		$schedules = $data->getStructureScheduleSummary();
		$summary = $data->getTotalScheduleSummary();
		$teachers = $data->getTeachers();
		$teacherSummary = $data->getTotalTeacherScheduleSummary();
		$arrcls = array();
		foreach($classes as $class) {
			$subjectId = $class['subjectId'];
			if(!isset($arrcls[$subjectId])) {
				$arrcls[$subjectId] = array();
			}
			$arrcls[$subjectId][] = $class;
		}
	?}
{each $arrcls as $clss}
<div id="paymentStatTab" class="easyui-tabs" style="width:1360px;height:auto;" data-options="onSelect: paymentStatTabSelect, href:'_content.html',closable:true">
	<div title="Thông tin">
		<h1><center>Thống kê thanh toán</center></h1>
	</div>
	{each $clss as $class}
	<div title="{class[name]}" data-options="href:'{url /demo/paymentStatTab}?classId={class[id]}',closable:true">
	
	</div>
	{/each}
</div>
{/each}
{children all}
<script type="text/javascript">
	function makeOrder(classId, studentId, periodId, amount) {
		$('#dlg-order').dialog('open').dialog('setTitle','Edit User');
		var row = {classId: classId, studentId: studentId, payment_periodId: periodId, amount: amount};
		$('#fm-order').form('load', row);
	}
	pzk.elements.order = {
		save: function() {
			$('#fm-order').form('submit', {
				url: '/index.php/Dtable/add?table=student_order',
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg-order').dialog('close');        // close the dialog
						window.location.reload();
					}
				}
			});
		}
	};
	
	function paymentStatTabSelect(title, index) {
		window.localStorage.paymentStatTabIndex = index;
	}
	
	$('#paymentStatTab').tabs('setSelected', window.localStorage.paymentStatTabIndex);
</script>