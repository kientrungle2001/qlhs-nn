<frm.form id="loginForm" title="Đăng ký học phong thủy" action="{url /user/studyPost}">
	<frm.formItem type="user-defined" name="label" label="">
		<h2>Đăng ký học phong thủy</h2>
	</frm.formItem>
	<frm.formItem name="fullName" required="true" validatebox="true" label="Họ và tên" value="{_REQUEST[fullName]}" />
	<frm.formItem name="email" required="true" validatebox="true" label="Email" value="{_REQUEST[email]}" />
	<frm.formItem name="phone" label="Số điện thoại" value="{_REQUEST[phone]}" />
	<frm.formItem name="address" label="Địa chỉ" value="{_REQUEST[address]}" />
	<frm.formItem name="send" type="submit" label="" value="Đăng ký" />
</frm.form>