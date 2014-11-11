<frm.form id="newsletterForm" title="Đăng ký nhận thư báo" action="{url /newsletter/subscribePost}">
	<frm.formItem type="user-defined" name="label" label="">
		<h2>Đăng ký nhận thư báo</h2>
	</frm.formItem>
	<frm.formItem name="fullName" required="true" validatebox="true" label="Họ và tên" value="{_REQUEST[fullName]}" />
	<frm.formItem name="email" type="email" required="true" validatebox="true" label="Email" value="{_REQUEST[email]}" />
	<frm.formItem name="send" type="submit" label="" value="Đăng ký" />
</frm.form>