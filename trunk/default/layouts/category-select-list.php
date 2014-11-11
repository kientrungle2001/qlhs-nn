<select {attr id} {attr name} {attr multiple} class="easyui-combobox2">
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
<option value="{item[value]}" {selected} {rel}>{item[label]}</option>
<?php
}
}
?>
</select>

<?php if(isset($data->dependence)) { ?>
<?php $randomField = 'randomField' . rand(0, 1000000); 
$randomTime = rand(1000, 1500);
?>
<div id="{randomField}" />
<script type="text/javascript">
	setTimeout(function() {
		var $form = $('#{randomField}').parents('form');
		$form.find('name=[{prop dependence}]').change(function() {
			if($(this).val() == '') {
				$form.find('[name={prop id}]').find('option').show();
			} else {
				$form.find('[name={prop id}]').find('option').hide();
				$form.find('[name={prop id}]').find('option[rel="'+$(this).val()+'"]').show();
			}
		});
	}, {randomTime});
</script>
<?php } ?>