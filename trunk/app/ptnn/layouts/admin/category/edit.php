<?php $item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$parents = _db()->select('*')->from('categories')->result();
$parents = buildArr($parents, 'parent', 0);

$questionTypes = _db()->select('*')->from('questiontype')->result();
$question_types = explode(',', $item['question_types']);
?>
<form role="form" method="post" action="{url /admin_category/editPost}">
  	<input type="hidden" name="id" value="{item[id]}" />
 	<div class="form-group col-xs-12">
	  	<div class="col-xs-3">
	    	<label for="name">Tên dạng bài tập </label>
	    </div>
	    <div class="col-xs-9">
	    	<input type="text" class="form-control col-xs-4" id="name" name="name" placeholder="Tên danh mục" value="{item[name]}">
	   	</div>
 	</div>

	<div class="form-group col-xs-12">
		<div class="col-xs-3">
	    	<label for="router" class="2">Tên đường dẫn</label>
	    </div>
	    <div class="col-xs-9">
	    	<input type="text" class="form-control col-xs-4" id="router" name="router" placeholder="Đường dẫn" value="{item[router]}">
	    </div>
	</div>
	
	<div class="form-group col-xs-12">
	  	<div class="col-xs-3">
	    	<label for="parent" class="2">Danh mục cha</label>
	    </div>
	    <div class="col-xs-9">
	    <select class="form-control col-xs-4" id="parent" name="parent" placeholder="Danh mục cha" value="{item[parent]}">
			<option value="0">Danh mục gốc</option>
			{each $parents as $parent}
				<?php 
				$selected = '';
				if($parent['id'] == $item['parent']) { $selected = 'selected'; }?>
				<option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['level']); ?>{parent[name]}</option>
			{/each}
		</select>
		</div>
	</div>
	
	<div class="form-group col-xs-12">
  	<div class="col-xs-3">
		<label for="question_types">Các dạng bài tập</label>
	</div>
    <div class="col-xs-9">
	    <select multiple="multiple" class="form-control" id="question_types" name="question_types[]" value="{item[question_types]}"  style="height: 300px">
			{each $questionTypes as $type}
				<?php
				$selected = '';
				if(in_array($type['id'], $question_types)) {
					$selected = 'selected="selected"';
				}
				?>
			
				<option {selected} value="{type[id]}">{type[name]}</option>
			{/each}
		</select>
	</div>
  </div>
  
	<div class="form-group col-xs-12">
		<div class="col-xs-4 col-xs-offset-3">
		  	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
		  	<a href="{url /admin_category/index}" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
	  	</div>
  	</div>
</form>