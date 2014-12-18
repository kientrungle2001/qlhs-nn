<?php $items = $data->getItems();
	$items = buildArr($items,'parent',0);
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên Tin Tức</th>
		<th>Miêu tả</th>
		<th>Nội Dung</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
	$news = str_repeat($tab, $item['lever'])
	.$item['title']
	.$item['content']
	.$item['brief'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td>{item[title]}</td>
		<td>{item[brief]}</td>
		<td>{item[content]}</td>
		<td colspan="3">
		<a href="{url /admin_news/add}/{item[id]}">Thêm 
        <a href="{url /admin_news/edit}/{item[id]}">Sửa		
		<a href="{url /admin_news/del}/{item[id]}">Xóa
		</td>
	
	</tr>
	{/each}
	
</table>