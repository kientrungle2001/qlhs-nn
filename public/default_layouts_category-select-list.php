<?php 
$data->items = _db()->query($data->sql);
?>
<select <?php $tmp = @$data->id; if (isset($data->id) && $data->id !== "" && $data->id !== false) {echo 'id="'.$tmp.'"'; } ?> <?php $tmp = @$data->name; if (isset($data->name) && $data->name !== "" && $data->name !== false) {echo 'name="'.$tmp.'"'; } ?> <?php $tmp = @$data->multiple; if (isset($data->multiple) && $data->multiple !== "" && $data->multiple !== false) {echo 'multiple="'.$tmp.'"'; } ?> class="easyui-combobox2">
<option value=""></option>
<?php
if(isset($data->items) && is_array($data->items)) {
foreach($data->items as $item) {
	$selected = '';
	$rel = '';
	if ($item['value'] == @$data->value) {
		$selected = 'selected="selected"';
	}
	if(isset($data->dependence) && isset($data->dependenceField)) {
		$rel = 'rel="'.@$item[$data->dependenceField].'"';
	}
?>
<option value="<?php echo @$item['value'];?>" <?php echo @$selected;?> <?php echo @$rel;?>><?php echo @$item['label'];?></option>
<?php
}
}
?>
</select>

<?php if(isset($data->dependence)) { ?>
<?php $randomField = 'randomField' . rand(0, 1000000); 
$randomTime = rand(1000, 1500);
?>
<div id="<?php echo @$randomField;?>" />
<script type="text/javascript">
	setTimeout(function() {
		var $form = $('#<?php echo @$randomField;?>').parents('form');
		$form.find('name=[<?php echo @$data->dependence;?>]').change(function() {
			if($(this).val() == '') {
				$form.find('[name=<?php echo @$data->id;?>]').find('option').show();
			} else {
				$form.find('[name=<?php echo @$data->id;?>]').find('option').hide();
				$form.find('[name=<?php echo @$data->id;?>]').find('option[rel="'+$(this).val()+'"]').show();
			}
		});
	}, <?php echo @$randomTime;?>);
</script>
<?php } ?>