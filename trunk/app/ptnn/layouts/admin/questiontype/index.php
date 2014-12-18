<?php 
	$keyword = pzk_session('questionsKeyword');
	$orderBy = pzk_session('questionsOrderBy');


	$pageSize = pzk_session('questionsPageSize');
	if($pageSize) {
		$data->pageSize = $pageSize;
	}
	$data->pageNum = pzk_request('page');
	$items = $data->getItems($keyword, array('name'));
	$countItems = $data->getCountItems($keyword, array('name'));
	$pages = ceil($countItems / $data->pageSize);	

?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
  </div><!-- /.container-fluid -->
</nav>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}

	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_questiontype/detail}/{item[id]}">{item[name]}</a></td>
		<td><a class="btn btn-default" href="{url /admin_questiontype/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_questiontype/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="6">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_questiontype/changePageSize}?pageSize=' + this.value;">
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
		<a class="btn {btn}" href="{url /admin_questiontype/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	<tr>
		<td colspan="6"><a class="btn btn-default" href="{url /admin_questiontype/add}">Thêm câu hỏi</a></td>
	</tr>
</table>