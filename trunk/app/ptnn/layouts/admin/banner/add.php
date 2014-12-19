<?php 
$parentId = $data->getParentId();
$parents = _db()->select('*')->from('banner')->result();
$row = pzk_validator()->getEditingData();
?>
<form role="form" method="post" action="{url /admin_banner/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Tên banner</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Tên tin tức" value="{row[title]}">
  </div>
  <div class="form-group">
    <label for="brief">Ngày tạo</label>
    <input type="date" class="form-control" id="ngaytao" name="ngaytao" placeholder="Nhập nội dung" value="{row[ngaytao]}">
  </div>
  <div class="form-group">
    <label for="title">Code</label>
    <input type="text" class="form-control" id="code" name="code" placeholder="Nhập code" value="{row[code]}">
  </div>
  <div class="form-group">
    <label for="title">Hình ảnh</label>
    <input type="file" class="form-control" id="img" name="img" placeholder="Tên tin tức" value="{row[img]}">
  </div>
 
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_banner/index}">Quay lại</a>
</form>