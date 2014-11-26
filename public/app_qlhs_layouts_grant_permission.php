<?php
$permission = pzk_element('permission');
$controllers = $permission->getAllControllers();
$types = $permission->getAllUserTypes();
$statuses = _db()->select('*')->from('profile_controller_permission')->result();
?>
<table border="1" style="border-collapse: collapse;">
	<tr>
		<th>Controller</th><th>Action</th><?php foreach ( $types as $type ) : ?><th><?php echo @$type;?></th><?php endforeach; ?>
	</tr>
	<?php foreach ( $controllers as $controller ) : ?>
		<?php $controllerName = $controller['controller']; $actions = $controller['actions']; ?>
	<?php foreach ( $actions as $action ) : ?>
	<tr>
		<td><?php echo @$controllerName;?></td><td><?php echo @$action;?></td><?php foreach ( $types as $type ) : ?><td>
			<?php if ( @$type=="Administrator" ) : ?>
				Yes
			<?php else: ?>
				<select id="permission_<?php echo @$type;?>_<?php echo @$controllerName;?>_<?php echo @$action;?>"
						onchange="submitPermission('<?php echo @$type;?>','<?php echo @$controllerName;?>', '<?php echo @$action;?>', this.value)">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			<?php endif; ?>
			
		</td><?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
	<?php endforeach; ?>
</table>
<script type="text/javascript">
function submitPermission(type, controller, action, status) {
	$.ajax({
		type: 'post',
		method: 'post',
		url: BASE_URL + '/index.php/Dtable/replace?table=profile_controller_permission',
		data: {type: type, controller: controller, action: action, status: status},
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
var statuses = <?php echo json_encode($statuses)?>;
setTimeout(function(){
	$(document).ready(function(e) {
		for(var i=0; i < statuses.length; i++) {
			
			var controller = statuses[i]['controller'];
			var action = statuses[i]['action'];
			var type = statuses[i]['type'];
			var status = statuses[i]['status'];
			$('#permission_' + type + '_' + controller + '_' + action).val(status);
		}
	});
}, 1000);
</script>