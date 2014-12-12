<?php 
$categories = _db()->select('*')->from('categories')->result(); 
$categories = buildArr($categories,'parent',0);
?>
<form id="questionsAddForm" role="form" method="post" action="{url /admin_questions/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group clearfix">
    <label for="name">Tên câu hỏi</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên câu hỏi" value="{_REQUEST[name]}">
  </div>
  <div class="form-group clearfix">
    <label for="type">Loại câu hỏi</label>
    <select class="form-control" id="type" name="type" placeholder="Loại" value="{item[type]}">
		<option value="tracnghiem">Trắc nghiệm</option>
		<option value="dientu">Điền từ vào chỗ trống</option>
	</select>
  </div>
  <div class="form-group">
    <label for="name">Danh mục</label>
    <select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="{item[categoryIds]}" style="height: 300px">
	{each $categories as $cat}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';	
	$tabs = str_repeat($tab, $cat['lever']);
	$catName = $tabs.$cat['name'];
	?>
	<option value="{cat[id]}">{catName}</option>
	{/each}
	</select>
  </div>
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questions/index}">Quay lại</a>
  </div>
</form>
<?php 
$addValidator = json_encode(pzk_app()->controller->addValidator);
?>
<script>
$('#questionsAddForm').validate({addValidator});
</script>