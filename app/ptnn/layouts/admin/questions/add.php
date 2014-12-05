<form role="form" method="post" action="{url /admin_questions/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="name">Tên câu hỏi</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên câu hỏi" value="{_REQUEST[name]}">
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questions/index}">Quay lại</a>
</form>