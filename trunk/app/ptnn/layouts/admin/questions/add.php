<form id="questionsAddForm" role="form" method="post" action="{url /admin_questions/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group clearfix">
    <label for="name">Tên câu hỏi</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên câu hỏi" value="{_REQUEST[name]}">
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