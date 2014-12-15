<?php 
$controller = pzk_controller();
$item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$row = $item;
$editFieldSettings = $controller->editFieldSettings;
?>
<form role="form" method="post" action="{url /admin}_{controller.module}/editPost">
  <input type="hidden" name="id" value="{item[id]}" />
  {each $editFieldSettings as $field}
  {? if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') : ?}
  <div class="form-group clearfix">
    <label for="{field[index]}">{field[label]}</label>
    <input type="{field[type]}" class="form-control" id="{field[index]}" name="{field[index]}" placeholder="{field[label]}" value="{? if ($field['type'] != 'password') { echo $row[$field['index']]; } ?}">
  </div>
  {? elseif($field['type'] == 'status'): ?}
  <div class="form-group"><?php 
		$selected0 = ''; $selected1 = ''; 
		$selectedField = 'selected'.$row['status'];
		$$selectedField = 'selected';
		?>
    <label for="{field[index]}">{field[label]}</label>
    <select class="form-control" id="{field[index]}" name="{field[index]}" placeholder="Chưa kích hoạt" value="{item[status]}">
		<option value="0" {selected0}>Chưa kích hoạt</option>
		<option value="1" {selected1}>Đã kích hoạt</option>
	</select>
  </div>
  {? endif ?}
  {/each}
  
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin}_{controller.module}/index">Quay lại</a>
</form>