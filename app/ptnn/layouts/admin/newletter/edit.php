<?php $item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$parents = _db()->select('*')->from('mail')->result();

?>
<form role="form" method="post" action="{url /admin_newletter/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="title">Địa chỉ email</label>
    <input type="email" class="form-control" id="mail" name="mail" placeholder="Địa chỉ email" value="{item[mail]}">
  </div>
<div class="form-group">
    <label for="title">Ngày đăng ký</label>
    <input type="date" class="form-control" id="dateregister" name="dateregister" value="{item[dateregister]}">
  </div>

  
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_newletter/index}">Quay lại</a>
</form>