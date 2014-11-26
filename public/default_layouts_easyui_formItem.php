<tr>
	<td><?php echo @$data->label;?><?php echo @$data->text;?></td>
	<td>
	<?php if (@$data->type == 'user-defined') { ?>
		<?php $data->displayChildren('all');?>
	<?php } else { ?>
	<input <?php $tmp = @$data->type; if (isset($data->type) && $data->type !== "" && $data->type !== false) {echo 'type="'.$tmp.'"'; } ?> <?php $tmp = @$data->name; if (isset($data->name) && $data->name !== "" && $data->name !== false) {echo 'name="'.$tmp.'"'; } ?> <?php $tmp = @$data->value; if (isset($data->value) && $data->value !== "" && $data->value !== false) {echo 'value="'.$tmp.'"'; } ?> <?php if ( @$data->validatebox=="true" ) : ?>class="easyui-validatebox"<?php endif; ?> <?php $tmp = @$data->required; if (isset($data->required) && $data->required !== "" && $data->required !== false) {echo 'required="'.$tmp.'"'; } ?>>
	<?php } ?>
	</td>
</tr>