<?php $items = $data->getItems();
	$items = buildArr($items,'parent',0);
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên danh mục</th>
		<th>Trạng thái</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
	$cate = str_repeat($tab, $item['lever']).$item['name'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_category/edit}/{item[id]}">{cate}</a> (
		Route: <a href="{url /}{item[router]}/{item[id]}" target="_blank">{item[router]}</a>
		Alias: <a href="{url /}{item[alias]}-{item[id]}" target="_blank">{item[alias]}</a> )
		</td>
		<td><?php if($item['status']) { ?>Hoạt động (<a href="{url /admin_category/changeStatus}/{item[id]}">dừng</a>)<?php } else { ?>Không hoạt động (<a href="{url /admin_category/changeStatus}/{item[id]}">mở</a>)<?php } ?></td>
		<td><a href="{url /admin_category/add}/{item[id]}">Thêm</td>
		<td><a href="{url /admin_category/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="5"><a href="{url /admin_category/add}">Thêm danh mục</a></td>
	</tr>
</table>