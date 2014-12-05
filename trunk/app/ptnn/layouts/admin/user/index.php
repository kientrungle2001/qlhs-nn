<?php $items = $data->getItems(); 
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên</th>
		<th>Tài khoản</th>
		<th>Email</th>
		<th>Số điện thoại</th>
		<th>Trạng thái</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<tr>
		<td>{item[id]}</td>
		<td>{item[name]}</td>
		<td>{item[username]}</td>
		<td>{item[email]}</td>
		<td>{item[phone]}</td>
		<td>{item[status]}</td>
		<td><a href="{url /admin_user/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_user/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="8"><a href="{url /admin_user/add}">Thêm người dùng</a></td>
	</tr>
</table>