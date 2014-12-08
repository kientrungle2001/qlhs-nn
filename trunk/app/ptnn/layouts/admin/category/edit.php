<?php $item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$parents = _db()->select('*')->from('categories')->result();
$parents = buildArr($parents, 'parent', 0);
?>
<form role="form" method="post" action="{url /admin_category/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Tên danh mục</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên danh mục" value="{item[name]}">
  </div>
  <div class="form-group">
    <label for="parent">Danh mục cha</label>
    <select class="form-control" id="parent" name="parent" placeholder="Danh mục cha" value="{item[parent]}">
		<option value="0">Danh mục gốc</option>
		{each $parents as $parent}
			<?php 
			$selected = '';
			if($parent['id'] == $item['parent']) { $selected = 'selected'; }?>
			<option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['lever']); ?>{parent[name]}</option>
		{/each}
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_category/index}">Quay lại</a>
</form>