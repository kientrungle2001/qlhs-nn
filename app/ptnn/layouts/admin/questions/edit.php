<?php 
	$item = $data->getItem(); 
	$categories = _db()->select('*')->from('categories')->result(); 
	$categories = buildArr($categories,'parent',0);
	$categoryIds = explode(',', $item['categoryIds']);
    $questionTypes = _db()->select('*')->from('questiontype')->result();
?>
<form id="questionsEditForm" role="form" method="post" action="{url /admin_questions/editAllCatePost}">
  <br />
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questions/index}">Quay lại</a><br />
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Tên</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên câu hỏi" value="{item[name]}">
  </div>
  <div class="form-group clearfix">
    <label for="type">Loại câu hỏi</label>
    <select class="form-control" id="type" name="type" placeholder="Loại" value="{item[type]}">
        <option>Chọn loại câu hỏi</option>
        {each $questionTypes as $val}
		<option <?php if($item['type'] == $val['id']) { echo 'selected="selected"'; } ?> value="{val[id]}">{val[name]}</option>
        {/each}

	</select>
	<script>
	$('#type').val('{item[type]}');
	</script>
  </div>

    <div class="form-group clearfix">
        <label for="type">Mức độ câu hỏi</label>
        <select class="form-control" id="level" name="level" placeholder="Loại" value="{item[level]}">
            <option value="">Chọn mức độ câu hỏi</option>
            <option <?php if($item['level'] ==1) { echo 'selected="selected"'; } ?> value="1">Dễ</option>
            <option <?php if($item['level'] ==2) { echo 'selected="selected"'; } ?> value="2">Bình thường</option>
            <option <?php if($item['level'] ==3) { echo 'selected="selected"'; } ?> value="3">Khó</option>
        </select>
        <script>
            $('#type').val('{item[type]}');
        </script>
    </div>

  <div class="form-group">
    <label for="name">Danh mục</label>
    <select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="{item[categoryIds]}" style="height: 300px">
	{each $categories as $cat}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';	
	$tabs = str_repeat($tab, $cat['lever']);
	$catName = $tabs.$cat['name'];
	$selected = '';
	if(in_array($cat['id'], $categoryIds)) {
		$selected = 'selected="selected"';
	}
	?>
	<option {selected} value="{cat[id]}">{catName}</option>
	{/each}
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questions/index}">Quay lại</a>
</form>
<?php 
$editValidator = json_encode(pzk_app()->controller->editValidator);
?>
<script>
$('#questionsEditForm').validate({editValidator});
</script>