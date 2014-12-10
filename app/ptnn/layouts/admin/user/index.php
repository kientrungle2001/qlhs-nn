<?php 
$keyword = pzk_session('userKeyword');
$orderBy = pzk_session('userOrderBy');
if($orderBy) {
	$data->orderBy = $orderBy;
}
$pageSize = pzk_session('userPageSize');
if($pageSize) {
	$data->pageSize = $pageSize;
}
$data->pageNum = pzk_request('page');
$items = $data->getItems($keyword, array('name', 'username', 'email', 'phone', 'address'));
$countItems = $data->getCountItems($keyword, array('name', 'username', 'email', 'phone', 'address'));
$pages = ceil($countItems / $data->pageSize);

?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" action="{url /admin_user/searchPost}">
        <div class="form-group">
          <input type="text" name="keyword" class="form-control" placeholder="Từ khóa" value="{keyword}">
        </div>
        <button type="submit" class="btn btn-default">Tìm kiếm</button>
      </form>
	  <form class="navbar-form navbar-right" role="sort">
        <div class="form-group">
          <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='{url /admin_user/changeOrderBy}?orderBy=' + this.value;">
			<option value="id asc">ID tăng dần</option>
			<option value="id desc">ID giảm dần</option>
			<option value="name asc">Tên tăng dần</option>
			<option value="name desc">Tên giảm dần</option>
			<option value="username asc">Username tăng dần</option>
			<option value="username desc">Username giảm dần</option>
		  </select>
		  <script type="text/javascript">
			$('#orderBy').val('{orderBy}');
		  </script>
        </div>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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
		<td><?php if($item['status']) { ?>Hoạt động (<a href="{url /admin_user/changeStatus}/{item[id]}">dừng</a>)<?php } else { ?>Không hoạt động (<a href="{url /admin_user/changeStatus}/{item[id]}">mở</a>)<?php } ?></td>
		<td><a href="{url /admin_user/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_user/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="8">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_user/changePageSize}?pageSize=' + this.value;">
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
			if($page == $data->pageNum) { $btn = 'btn-primary'; } 
			else { $btn = 'btn-default'; }
		?>
		<a class="btn {btn}" href="{url /admin_user/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	<tr>
		<td colspan="8"><a class="btn btn-default" href="{url /admin_user/add}">Thêm người dùng</a></td>
	</tr>
</table>