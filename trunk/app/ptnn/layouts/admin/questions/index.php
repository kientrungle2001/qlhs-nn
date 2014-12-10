<?php 
	$keyword = pzk_session('questionsKeyword');
	$orderBy = pzk_session('questionsOrderBy');
	$categoryId = pzk_session('questionsCategoryId');
	if($categoryId) {
		$data->conditions .= " and categoryIds like '%,$categoryId,%'";
	}
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
	$categories = _db()->select('*')->from('categories')->result();
	$cats = array();
	foreach($categories as $cat) {
		$cats[$cat['id']] = $cat;
	}
	function getCategoriesName($item, $categories) {
		$rs = array();
		$catIds = explode(',', $item['categoryIds']);
		
		foreach($catIds as $catId) {
			if($catId) {
				$rs[] = $categories[$catId]['name'];
			}
		}
		return implode(', ', $rs);
	}
	$categoryTree = buildArr($categories,'parent',0);
?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" action="{url /admin_questions/searchPost}">
        <div class="form-group">
          <input type="text" name="keyword" class="form-control" placeholder="Từ khóa" value="{keyword}">
        </div>
        <button type="submit" class="btn btn-default">Tìm kiếm</button>
      </form>
	  <form class="navbar-form navbar-right" role="sort">
        <div class="form-group">
          <select id="categoryId" name="categoryId" class="form-control" placeholder="Danh mục" onchange="window.location='{url /admin_questions/changeCategoryId}?categoryId=' + this.value;">
			<option value="">Tất cả</option>
			{each $categoryTree as $cat}
			<option value="{cat[id]}"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['lever']);?>{cat[name]}</option>
			{/each}
		  </select>
		  <script type="text/javascript">
			$('#categoryId').val('{categoryId}');
		  </script>
        </div>
		<div class="form-group">
          <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='{url /admin_questions/changeOrderBy}?orderBy=' + this.value;">
			<option value="id asc">ID tăng dần</option>
			<option value="id desc">ID giảm dần</option>
			<option value="name asc">Tên tăng dần</option>
			<option value="name desc">Tên giảm dần</option>
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
		<th>Danh mục</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$catNames = getCategoriesName($item, $cats);
	?>
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_questions/detail}/{item[id]}">{item[name]}</a></td>
		<td>{catNames}</td>
		<td><a class="btn btn-default" href="{url /admin_questions/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_questions/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="5">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_questions/changePageSize}?pageSize=' + this.value;">
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
		<a class="btn {btn}" href="{url /admin_questions/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	<tr>
		<td colspan="5"><a class="btn btn-default" href="{url /admin_questions/add}">Thêm câu hỏi</a></td>
	</tr>
</table>