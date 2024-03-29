<?php $item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$parents = _db()->select('*')->from('news')->result();
$parents = buildArr($parents, 'parent', 0);
?>
<form role="form" method="post" action="{url /admin_news/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="title">Tên tin tức</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Tên tin tức" value="{item[title]}">
  </div>
<div class="form-group">
    <label for="title">Miêu tả</label>
    <input type="text" class="form-control" id="brief" name="brief" placeholder="Tên tin tức" value="{item[brief]}">
  </div>
<div class="form-group">
    <label for="content">Nội dung</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Nội dung" value="{item[content]}">
</div>

  <div class="form-group">
    <label for="parent">Danh mục cha</label>
    <select class="form-control" id="parent" name="parent" placeholder="Danh mục cha" value="{item[parent]}">
		<option value="0">Danh mục gốc</option>
		{each $parents as $parent}
			<?php 
			$selected = '';
			if($parent['id'] == $item['parent']) { $selected = 'selected'; }?>
			<option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['level']); ?>{parent[title]}</option>
		{/each}
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_news/index}">Quay lại</a>
</form>