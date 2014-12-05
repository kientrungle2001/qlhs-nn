<?php $item = $data->getItem(); 
?>
<form role="form" method="post" action="{url /admin_user/delPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa người dùng?</label>
    <input type="text" disabled class="form-control" id="name" name="name" placeholder="Tên người dùng" value="{item[name]}">
  </div>
  <div class="form-group">
    <label for="username">Tài khoản</label>
    <input type="text" disabled class="form-control" id="username" name="username" placeholder="Tài khoản" value="{item[username]}">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" disabled class="form-control" id="email" name="email" placeholder="Email" value="{item[email]}">
  </div>
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="{url /admin_user/index}">Không, quay lại</a>
</form>