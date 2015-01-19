<?php 
	$keyword = pzk_session('questiontypeKeyword');
	$orderBy = pzk_session('questiontypeOrderBy');
	
	$pageSize = pzk_session('questiontypePageSize');
	if($pageSize) {
		$data->pageSize = $pageSize;
	}
	$data->pageNum = pzk_request('page');
	$items = $data->getItems($keyword, array('name'));
	$countItems = $data->getCountItems($keyword, array('name'));
	$pages = ceil($countItems / $data->pageSize);	

?>
<div class="well">
<form role="search" action="{url /admin_questiontype/searchPost}">
	<div class="row">
		<div class="form-group col-xs-3">
			<label for="keyword">Dạng câu hỏi</label><br>
        	<input class="form-control input-sm" type="text" name="keyword" id="keyword"  placeholder="Dạng bài" value="{keyword}" />
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
<script type="text/javascript">
	$('#"keyword"').val('{"keyword"}');
</script>


</div>
<div class="panel panel-default">
	<div class="panel-heading">
		Danh mục dạng câu hỏi  <a class="btn btn-primary btn-xs pull-right" role="button" href="{url /admin_questiontype/add}"><span class="glyphicon glyphicon-circle-arrow-right"></span> Thêm dạng câu hỏi</a>
	</div>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Tên dạng câu hỏi</th>
			<th>Code</th>
			<th>Dạng bài tập</th>
			<th colspan="2">Hành động</th>
		</tr>
		{each $items as $item}
	
		<tr>
			<td>{item[id]}</td>
			<td><a href="{url /admin_questiontype/edit}/{item[id]}"  class="text-center">{item[name]}</a></td>
			<td>{item[question_type]}</td>
			<td>{item[group_question]}</td>
			<td width="7%">
				<a href="{url /admin_questiontype/edit}/{item[id]}"  class="text-center"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
			</td>
			<td width="7%"> 
				<a class="color_delete text-center" onclick="return confirm_delete('Do you want delete this record?')" href="{url /admin_questiontype/del}/{item[id]}"><span class="glyphicon glyphicon-remove"></span> Xóa</a>
			</td>
		</tr>
		{/each}
	</table>
</div>
<div class="clearfix pull-right">
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

</div>