
<?php $items = $data->getItems();
	$items = buildArr($items,'parent',0);
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên Banner</th>
		<th>Ngày Tạo</th>
		<th>Ảnh</th>
		<th>Code</th>
		<th>Số lượt Click</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
	$banner = str_repeat($tab, $item['lever'])
	.$item['title']
	.$item['ngaytao']
	.$item['click']
	.$item['img']
	.$item['code'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td>{item[title]}</td>
		<td>{item[ngaytao]}</td>
		<td>{item[img]}</td>
		<td>{item[code]}</td>
		<td>{item[click]}</td>
		<td colspan="3">
		<a href="{url /admin_banner/add}/{item[id]}">Thêm 
        <a href="{url /admin_banner/edit}/{item[id]}">Sửa		
		<a href="{url /admin_banner/del}/{item[id]}">Xóa
		</td>
	
	</tr>
	{/each}
	
</table>