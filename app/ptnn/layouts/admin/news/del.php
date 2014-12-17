<?php $item = $data->getItem(); 
$parents = _db()->select('*')->from('news')->result();
$parents = buildArr($parents, 'parent', 0);
?>
<form role="form" method="post" action="{url /admin_news/delPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa tin tức?</label>
    <input type="text" disabled class="form-control" id="name" name="name" placeholder="Tên danh mục" value="{item[title]}">
  </div>
  
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="{url /admin_news/index}">Không, quay lại</a>
</form>