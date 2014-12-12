<form id="userAddForm" role="form" method="post" action="{url /admin_user/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group clearfix">
    <label for="name">Tên</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên người dùng" value="{_REQUEST[name]}">
  </div>
  <div class="form-group clearfix">
    <label for="username">Tên đăng nhập</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" value="{_REQUEST[username]}">
  </div>
  <div class="form-group clearfix">
    <label for="password">Mật khẩu</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
  </div>
  <div class="form-group clearfix">
    <label for="confirmpassword">Xác nhận mật khẩu</label>
    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Mật khẩu">
  </div>
  <div class="form-group clearfix">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
  </div>
  <div class="form-group clearfix">
    <label for="birthday">Ngày sinh</label>
    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Ngày sinh">
  </div>
  <div class="form-group clearfix">
    <label for="address">Địa chỉ</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Ngày sinh">
  </div>
  <div class="form-group clearfix">
    <label for="phone">Số điện thoại</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại">
  </div>
  <div class="form-group clearfix">
    <label for="idpassport">Số CMT/Hộ chiếu</label>
    <input type="text" class="form-control" id="idpassport" name="idpassport" placeholder="CMT/Hộ chiếu">
  </div>
  <div class="form-group clearfix">
    <label for="iddate">Ngày cấp</label>
    <input type="date" class="form-control" id="iddate" name="iddate" placeholder="Ngày cấp">
  </div>
  <div class="form-group clearfix">
    <label for="idplace">Nơi cấp</label>
    <input type="text" class="form-control" id="idplace" name="idplace" placeholder="Nơi cấp">
  </div>
  <div class="form-group clearfix">
	<label for="status">Trạng thái</label>
    <select class="form-control" id="status" name="status" placeholder="Chưa kích hoạt">
		<option value="0">Chưa kích hoạt</option>
		<option value="1">Đã kích hoạt</option>
	</select>
  </div>
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_user/index}">Quay lại</a>
  </div>
</form>