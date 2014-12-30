<?php $item = $data->getItem(); 
$parents = _db()->select('*')->from('mail')->result();

?>
<form role="form" method="post" action="{url /admin_newletter/delPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa email?</label>
    <input type="text" disabled class="form-control" id="email" name="email" placeholder="Địa chỉ mail" value="{item[mail]}">
  </div>
  
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="{url /admin_newletter/index}">Không, quay lại</a>
</form>