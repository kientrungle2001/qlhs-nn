<?php $items = $data->getItems(); 
	$items = buildArr($items,'parent',0);
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên danh mục</th>
		<th>Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';	
	$tabs = '';
	for ($i= 2; $i <= $item['lever'] ; $i++) { 
		$tabs = $tabs.$tab;
	}
	
	$cate = $tabs.$item['name'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_category/edit}/{item[id]}">{cate}</a></td>
		<td><a href="{url /admin_category/add}/{item[id]}">Thêm</td>
		<td><a href="{url /admin_category/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
</table>