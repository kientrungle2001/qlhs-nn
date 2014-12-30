<?php 
$parentId = $data->getParentId();
$parents = _db()->select('*')->from('mail')->result();

$row = pzk_validator()->getEditingData();
?>
<form role="form" method="post" action="{url /admin_newletter/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Địa chỉ mail</label>
    <input type="email" class="form-control" id="mail" name="mail" placeholder="Địa chỉ email" value="{row[mail]}">
  </div>
  <div class="form-group">
    <label for="brief">Ngày đăng ký</label>
    <input type="date" class="form-control" id="dateregister" name="dateregister" value="{row[dateregister]}">
 
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_newletter/index}">Quay lại</a>
</form>