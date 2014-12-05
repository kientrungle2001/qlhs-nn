<?php $item = $data->getItem(); ?>
<form role="form" method="post" action="{url /admin_user/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Tên</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên người dùng" value="{item[name]}">
  </div>
  <div class="form-group">
    <label for="username">Tên đăng nhập</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" value="{item[username]}">
  </div>
  <div class="form-group">
    <label for="password">Mật khẩu</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
  </div>
  <div class="form-group">
    <label for="confirmpassword">Xác nhận mật khẩu</label>
    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Mật khẩu">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{item[email]}">
  </div>
  <div class="form-group">
    <label for="birthday">Ngày sinh</label>
    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Ngày sinh" value="{item[birthday]}">
  </div>
  <div class="form-group">
    <label for="address">Địa chỉ</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Ngày sinh" value="{item[address]}">
  </div>
  <div class="form-group">
    <label for="phone">Số điện thoại</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{item[phone]}">
  </div>
  <div class="form-group">
    <label for="idpassport">Số CMT/Hộ chiếu</label>
    <input type="text" class="form-control" id="idpassport" name="idpassport" placeholder="CMT/Hộ chiếu" value="{item[idpassport]}">
  </div>
  <div class="form-group">
    <label for="iddate">Ngày cấp</label>
    <input type="date" class="form-control" id="iddate" name="iddate" placeholder="Ngày cấp" value="{item[iddate]}">
  </div>
  <div class="form-group">
    <label for="idplace">Nơi cấp</label>
    <input type="text" class="form-control" id="idplace" name="idplace" placeholder="Nơi cấp" value="{item[idplace]}">
  </div>
  <div class="form-group"><?php 
		$selected0 = ''; $selected1 = ''; 
		$selectedField = 'selected'.$item['status'];
		$$selectedField = 'selected';
		?>
    <label for="idplace">Trạng thái</label>
    <select class="form-control" id="status" name="status" placeholder="Chưa kích hoạt" value="{item[status]}">
		<option value="0" {selected0}>Chưa kích hoạt</option>
		<option value="1" {selected1}>Đã kích hoạt</option>
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_user/index}">Quay lại</a>
</form>