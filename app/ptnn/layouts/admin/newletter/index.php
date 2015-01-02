<?php $items = $data->getItems();
	//$items = buildArr($items,'parent',0);
	$keyword = pzk_session('questionsKeyword');
	$countItems = $data->getCountItems($keyword, array('name'));
	$pages = ceil($countItems / $data->pageSize);	
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Địa chỉ email</th>
		<th>Ngày đăng ký</th>
		<th>Trạng thái</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
	$news = str_repeat($tab, $item['id'])
	.$item['mail']
	.$item['dateregister']
	.$item['active'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td>{item[mail]}</td>
		<td>{item[dateregister]}</td>
		<td>{item[active]}</td>
		<td colspan="3">
		<a href="{url /admin_newletter/add}/{item[id]}">Thêm 
        <a href="{url /admin_newletter/edit}/{item[id]}">Sửa		
		<a href="{url /admin_newletter/del}/{item[id]}">Xóa
		</td>
	
	</tr>
	{/each}
	<tr>
		<td colspan="6">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_newletter/changePageSize}?pageSize=' + this.value;">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>
		  <script type="text/javascript">
			$('#pageSize').val('{pageSize}');
		  </script>
		<strong>Trang: </strong>
		<?php for ($page = 0; $page < $pages; $page++) { 
			if($page == $data->pageNum) {
				$btn = 'btn-primary';
			} else {
				$btn = 'btn-default';
			}
		?>
		<a class="btn {btn}" href="{url /admin_newletter/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	
</table>