<?php $items = $data->getItems(); 
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên</th>
		<th>Danh mục</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_questions/detail}/{item[id]}">{item[name]}</a></td>
		<td>{item[categoryIds]}</td>
		<td><a href="{url /admin_questions/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_questions/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="5"><a href="{url /admin_questions/add}">Thêm câu hỏi</a></td>
	</tr>
</table>