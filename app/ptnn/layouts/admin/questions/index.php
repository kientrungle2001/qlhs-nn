<?php 
	$keyword = pzk_session('questionsKeyword');
	$orderBy = pzk_session('questionsOrderBy');
	$categoryId = pzk_session('questionsCategoryId');
	$type = pzk_session('questionsType');
	if($categoryId) {
		$data->conditions .= " and categoryIds like '%,$categoryId,%'";
	}
	if($type) {
		$data->conditions .= " and `type` like '$type'";
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
    $questionTypes = _db()->select('*')->from('questiontype')->result();
	$cats = array();
	foreach($categories as $cat) {
		$cats[$cat['id']] = $cat;
	}
    function getQuestionTypeName($questionTypes, $questionTypeId) {
        $rs = '';
        foreach($questionTypes as $type) {
            if($type['id'] == $questionTypeId){
                $rs = $type['name'];
            }
        }
        return $rs;

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
<div class="well">
<form role="search" action="{url /admin_questions/searchPost}">
	<div class="row">
		<div class="form-group col-xs-2">
			<label for="keyword">Tên câu hỏi</label><br>
        	<input class="form-control input-sm" type="text" name="keyword" id="keyword"  placeholder="Câu hỏi" value="{keyword}" />
       	</div>
        <div class="form-group col-xs-2">
        	<label for="type">Loại câu hỏi</label><br>
			<select class="form-control input-sm" id="type" name="type" placeholder="Loại" value="{item[type]}" onchange="window.location='{url /admin_questions/changeType}?type=' + this.value;">
				<option value="">-- Tất cả --</option>
				<option value="tracnghiem">Trắc nghiệm</option>
				<option value="dientu">Điền từ</option>
			</select>
			<script type="text/javascript">
				$('#type').val('{type}');
  			</script>
		</div>
		
		<div class="form-group col-xs-4">
			<label for="categoryId">Dạng bài tập</label><br>
          	<select id="categoryId" name="categoryId" class="form-control input-sm" placeholder="Danh mục" onchange="window.location='{url /admin_questions/changeCategoryId}?categoryId=' + this.value;">
			<option value="">Tất cả</option>
			{each $categoryTree as $cat}
				<option value="{cat[id]}"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['lever']);?>{cat[name]}</option>
			{/each}
 		 	</select>
  			<script type="text/javascript">
				$('#categoryId').val('{categoryId}');
  			</script>
        </div>
        
        <div class="form-group col-xs-2">
        	<label>&nbsp;</label> <br>
        	<button type="submit" class="btn btn-primary btn-sm" value="1"><span class="glyphicon glyphicon-search"></span> Search</button>
        </div>
        <div class="form-group col-xs-2">
        	<label>&nbsp;</label> <br>
        	<button type="submit" class="btn btn-default btn-sm" value="0"><span class="glyphicon glyphicon-refresh"></span>Reset</button>
        </div>
	</div>
</form>
</div>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên</th>
		<th>Dạng bài tập</th>
		<th>Loại bài tập</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$catNames = getCategoriesName($item, $cats);
    $questionTypeName = getQuestionTypeName($questionTypes, $item['type']);
	?>
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_questions/detail}/{item[id]}">{item[name]}</a></td>
		<td>{catNames}</td>
		<td>{questionTypeName}</td>
		<td><a class="btn btn-default" href="{url /admin_questions/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_questions/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="6">
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
		<?php 
			for ($page = 0; $page < $pages; $page++):?>
				<?php 
				if($page == $data->pageNum) {
					$btn = 'btn-primary';
				} else {
					$btn = 'btn-default';
				}
				?>
		<a class="btn {btn}" href="{url /admin_questions/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php endfor; ?>
		</form>
		</td>
	</tr>
	<tr>
		<td colspan="6"><a class="btn btn-default" href="{url /admin_questions/add}">Thêm câu hỏi</a></td>
	</tr>
</table>