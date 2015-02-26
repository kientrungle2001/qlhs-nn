<?php 
$parentId = $data->getParentId();
$parents = _db()->select('*')->from('news')->result();
$parents = buildArr($parents, 'parent', 0);
$row = pzk_validator()->getEditingData();
?>
<form role="form" method="post" action="{url /admin_news/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Tên tin tức</label>
    <input type="text" class="form-control" id="titlenew" name="titlenew" placeholder="Tên tin tức" value="{row[titlenew]}">
  </div>
  <div class="form-group">
    <label for="brief">Miêu tả</label>
    <input type="text" class="form-control" id="brief" name="brief" placeholder="Nhập nội dung" value="{row[brief]}">
  </div>
  <div class="form-group">
    <label for="content">Nội dung</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Nhập nội dung" value="{row[content]}">
  </div>
  <div class="form-group">
    <label for="parent">Danh mục cha</label>
    <select class="form-control" id="parent" name="parent" placeholder="Danh mục cha" value="{row[parent]}">
		<option value="0">Danh mục gốc</option>
		{each $parents as $parent}
			<?php 
			$selected = '';
			if($parent['id'] == $parentId) { $selected = 'selected'; }?>
			<option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['level']); ?>{parent[title]}</option>
		{/each}
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_news/index}">Quay lại</a>
</form>