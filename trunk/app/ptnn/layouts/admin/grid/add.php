<?php 
	$controller = pzk_controller();
	$addFieldSettings = $controller->addFieldSettings;
	$row = pzk_validator()->getEditingData();
?>
<form id="{controller.module}AddForm" role="form" method="post" action="{url /admin}_{controller.module}/addPost">
  <input type="hidden" name="id" value="" />
  {each $addFieldSettings as $field}
  {? if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') : ?}
  <div class="form-group clearfix">
    <label for="{field[index]}">{field[label]}</label>
    <input type="{field[type]}" class="form-control" id="{field[index]}" name="{field[index]}" placeholder="{field[label]}" value="{? if ($field['type'] != 'password') { echo $row[$field['index']]; } ?}">
  </div>
  {? elseif($field['type'] == 'status'): ?}
  <div class="form-group clearfix">
	<label for="{field[index]}">{field[label]}</label>
    <select class="form-control" id="{field[index]}" name="{field[index]}" placeholder="Chưa kích hoạt">
		<option value="0">Chưa kích hoạt</option>
		<option value="1">Đã kích hoạt</option>
	</select>
  </div>
  {? endif ?}
  {/each}
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin}_{controller.module}/index">Quay lại</a>
  </div>
</form>