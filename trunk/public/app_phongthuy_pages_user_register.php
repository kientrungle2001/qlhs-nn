<frm.form id="loginForm" title="Đăng nhập" action="<?php echo BASE_REQUEST . '/user/registerPost'; ?>">
	<frm.formItem type="user-defined" name="label" label="">
		<h2>Đăng ký thành viên</h2>
	</frm.formItem>
	<frm.formItem name="fullName" required="true" validatebox="true" label="Họ và tên" value="<?php echo @$_REQUEST['fullName'];?>" />
	<frm.formItem name="username" required="true" validatebox="true" label="Tên đăng nhập" value="<?php echo @$_REQUEST['username'];?>" />
	<frm.formItem name="password" type="password" required="true" validatebox="true" label="Mật khẩu" />
	<frm.formItem name="confirmPassword" type="password" required="true" validatebox="true" label="Nhập lại mật khẩu" />
	<frm.formItem name="email" required="true" validatebox="true" label="Email" value="<?php echo @$_REQUEST['email'];?>" />
	<frm.formItem name="confirmEmail" required="true" validatebox="true" label="Nhập lại email" />
	<frm.formItem name="phone" label="Số điện thoại" value="<?php echo @$_REQUEST['phone'];?>" />
	<frm.formItem name="address" label="Địa chỉ" value="<?php echo @$_REQUEST['address'];?>" />
	<frm.formItem name="send" type="submit" label="" value="Đăng ký" />
</frm.form>