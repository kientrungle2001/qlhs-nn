<?php 
	$item = $data->getItem(); 
    $levels = _db()->select('*')->from('admin_level')->result();
?>
<form id="questionsEditForm" role="form" method="post" action="{url /admin_mod/editAllCatePost}">
  <br />
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_mod/index}">Quay lại</a><br />
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Tên đăng nhập</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên câu hỏi" value="{item[name]}">
  </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{item[password]}">
    </div>
  <div class="form-group clearfix">
    <label for="type">Nhóm người dùng</label>
    <select class="form-control" id="usertype_id" name="usertype_id" placeholder="Loại" value="{item[usertype_id]}">
        {each $levels as $val}
		<option <?php if($item['usertype_id'] == $val['id']) { echo 'selected="selected"'; } ?> value="{val[id]}">{val[level]}</option>
        {/each}

	</select>
	<script>
	$('#type').val('{item[type]}');
	</script>
  </div>


  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_mod/index}">Quay lại</a>
</form>
<?php 
$editValidator = json_encode(pzk_app()->controller->editValidator);
?>
<script>
$('#questionsEditForm').validate({editValidator});
</script>