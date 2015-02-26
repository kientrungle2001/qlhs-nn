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
	
	$question_types = $data->getQuestionType();
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
        	
			<select class="form-control input-sm" id="type" name="type" onchange="window.location='{url /admin_questions/changeType}?type=' + this.value;">
				<option value="">-- Tất cả --</option>
				<?php if(isset($question_types)):?>
					<?php foreach($question_types as $key	=>$value):?>
						
						<option value="<?=$value['question_type']?>" class="padding-left-10"> <?=$value['name']?></option>
								
					<?php endforeach;?>
				<?php endif;?>
			</select>
			<script type="text/javascript">
				$('#type').val('{type}');
  			</script>
		</div>
		
		<div class="form-group col-xs-4">
			<label for="categoryId">Dạng bài tập</label><br>
          	<select id="categoryId" name="categoryId" class="form-control input-sm" placeholder="Danh mục" onchange="window.location='{url /admin_questions/changeCategoryId}?categoryId=' + this.value;">
			<option value="">-- Tất cả --</option>
			{each $categoryTree as $cat}
				<option value="{cat[id]}"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['level']);?>{cat[name]}</option>
			{/each}
 		 	</select>
  			<script type="text/javascript">
				$('#categoryId').val('{categoryId}');
  			</script>
        </div>
        
        <div class="form-group col-xs-2">
        	<label>&nbsp;</label> <br>
        	<button type="submit" name ="submit_action" class="btn btn-primary btn-sm" value="<?=ACTION_SEARCH?>"><span class="glyphicon glyphicon-search"></span> Search</button>
        </div>
        <div class="form-group col-xs-2">
        	<label>&nbsp;</label> <br>
        	<button type="submit" name =submit_action class="btn btn-default btn-sm" value="<?=ACTION_RESET?>"><span class="glyphicon glyphicon-refresh"></span>Reset</button>
        </div>
	</div>
</form>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		Danh sách câu hỏi  <a class="btn btn-primary btn-xs pull-right" role="button" href="{url /admin_questions/add}"><span class="glyphicon glyphicon-circle-arrow-right"></span> Thêm câu hỏi</a>
	</div>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Tên</th>
			<th>Dạng bài tập</th>
			<th>Loại câu hỏi</th>
			<th colspan="2">Action</th>
		</tr>
		{each $items as $item}
		<?php 
		$catNames = getCategoriesName($item, $cats);
		?>
		<tr>
			<td>{item[id]}</td>
			<td><a href="{url /admin_questions/detail}/{item[id]}">{item[name]}</a></td>
			<td>{catNames}</td>
			<td><?php $obj_question = get_value_question_tyle($question_types, $item['type']); echo $obj_question['name']?></td>
			<td width="7%">
				<a href="{url /admin_questions/edit}/{item[id]}"  class="text-center" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a>
				<a class="color_delete text-center" onclick="return confirm_delete('Do you want delete this record?')" title="Xóa" href="{url /admin_questions/del}/{item[id]}"><span class="glyphicon glyphicon-remove"></span></a>
			</td>
		</tr>
		{/each}
	</table>
</div>


<div class="clearfix pull-right">
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
</div>