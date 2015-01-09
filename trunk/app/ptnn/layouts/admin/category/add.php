<?php 
$parentId = $data->getParentId();
$parents = _db()->select('*')->from('categories')->result();
$parents = buildArr($parents, 'parent', 0);
$row = pzk_validator()->getEditingData();
?>
<form role="form" method="post" action="{url /admin_category/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group col-xs-12">
    <label class="col-xs-2" for="name">Tên danh mục</label>
    <div class="col-xs-8">
    	<input type="text" class="form-control" id="name" name="name" placeholder="Tên danh mục" value="{row[name]}">
    </div>
  </div>
  <div class="form-group col-xs-12">
    <label class="col-xs-2" for="parent">Danh mục cha</label>
    <div class="form-group col-xs-8">
	    <select class="form-control" id="parent" name="parent" placeholder="Danh mục cha" value="{row[parent]}">
			<option value="0">Danh mục gốc</option>
			{each $parents as $parent}
				<?php 
				$selected = '';
				if($parent['id'] == $parentId) { $selected = 'selected'; }?>
				<option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['lever']); ?>{parent[name]}</option>
			{/each}
		</select>
	</div>
  </div>
  <div class="col-xs-12">
	  <button type="submit" class="btn btn-primary col-xs-offset-6"><span class="glyphicon glyphicon-saved"></span>Save</button>
	  <a class="btn btn-default col-xs-offset-1" href="{url /admin_category/index}">Cancel</a>
  </div>
</form>