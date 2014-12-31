<?php 
	$keyword = pzk_session('questionsKeyword');
	$orderBy = pzk_session('questionsOrderBy');

	if($orderBy) {
		$data->orderBy = $orderBy;
	}
	$pageSize = pzk_session('questionsPageSize');
	if($pageSize) {
		$data->pageSize = $pageSize;
	}
	$data->pageNum = pzk_request('page');
	$items = $data->getItems($keyword, array('name'));
	$countItems = $data->getCountItems($keyword, array('name'));
	$pages = ceil($countItems / $data->pageSize);

    $allLevels = _db()->select('*')->from('admin_level')->result();

    function getLevelTypeName($allLevels, $levelId) {
        $rs = '';
        foreach($allLevels as $type) {
            if($type['id'] == $levelId){
                $rs = $type['level'];
            }
        }
        return $rs;

    }


?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" action="{url /admin_mod/searchPost}">
        <div class="form-group">
          <input type="text" name="keyword" class="form-control" placeholder="Từ khóa" value="{keyword}">
        </div>
        <button type="submit" class="btn btn-default">Tìm</button>
      </form>
	  <form class="navbar-form navbar-right" role="sort">


		<div class="form-group">
          <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='{url /admin_mod/changeOrderBy}?orderBy=' + this.value;">
			<option value="id asc">ID ^</option>
			<option value="id desc">ID v</option>
			<option value="name asc">Tên ^</option>
			<option value="name desc">Tên v</option>
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
        <th>Nhóm người dùng</th>
        <th>Status</th>

		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
    <?php
    $level = getLevelTypeName($allLevels, $item['usertype_id']);
    ?>

	<tr>
		<td>{item[id]}</td>
		<td>{item[name]}</td>
        <td>{level}</td>
        <td>
            <input id="switch-{field[index]}-{item[id]}" type="checkbox" {if $item['status']}checked="checked"{/if} data-size="mini" />
            <script type="text/javascript">jQuery('#switch-{field[index]}-{item[id]}').bootstrapSwitch({onSwitchChange: function(evt,state) { {event changeStatus}({id: {item[id]}, status: state}); }})</script>
        </td>
		<td><a class="btn btn-default" href="{url /admin_mod/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_mod/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="6">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_mod/changePageSize}?pageSize=' + this.value;">
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
		<a class="btn {btn}" href="{url /admin_mod/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	<tr>
		<td colspan="6"><a class="btn btn-default" href="{url /admin_mod/add}">Thêm Người dùng</a></td>
	</tr>
</table>