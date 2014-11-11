<div class="row" id="loginbar">
	<div class="col-md-2">
		FB: <a href="https://www.facebook.com/kientrucsu.hoangtra">Kiến trúc sư Hoàng Trà</a>
	</div>
	<div class="col-md-4">
	<?php 
	$permission = pzk_element('permission');
	if($permission->user->get('type') == 'Guest') { ?>
	<form method="post" action="{url /user/loginPost}">
		<input type="text" name="username" placeholder="Tên đăng nhập" style="width: 45%"/>
		<input type="password" name="password" placeholder="Mật khẩu" style="width: 33%"/>
		<input type="submit" value="Đăng nhập" style="width: 20%"/>
	</form>
	<?php } else { ?>
	<a href="/user/logout">Đăng xuất</a>(<?php echo $permission->user->get('username'); ?>)
	<?php } ?>
	</div>
	<div class="col-md-6">
	<form method="get" action="{url /search/result}">
		<input type="text" name="keyword" placeholder="Từ khóa" style="width: 67%" />
		<input type="submit" value="Tìm kiếm" style="width: 32%;" />
	</form>
	</div>
</div>
