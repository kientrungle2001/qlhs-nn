<form role="form" method="post" action="{url /admin_newletter/sendallPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Tiêu đề</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" >
  </div>
  <div class="form-group">
    <label for="brief">Nội dung</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Nhập nội dung" >
  </div>
  <button type="submit" class="btn btn-primary">Gửi thư</button>
  <a href="{url /admin_newletter/index}">Quay lại</a>
	</form>