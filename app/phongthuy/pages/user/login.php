<frm.form id="loginForm" title="Đăng nhập" action="{url /user/loginPost}">
	<frm.formItem type="user-defined" name="label" label="">
		<h2>Đăng nhập</h2>
	</frm.formItem>
	<frm.formItem name="username" required="true" validatebox="true" label="Tên đăng nhập" />
	<frm.formItem name="password" type="password" required="true" validatebox="true" label="Mật khẩu" />
	<frm.formItem name="send" type="submit" label="" value="Đăng nhập" />
</frm.form>