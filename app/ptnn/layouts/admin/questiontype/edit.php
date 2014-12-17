<?php 
	$item = $data->getItem(); 

?>
<form id="questionsEditForm" role="form" method="post" action="{url /admin_questiontype/editPost}">

  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Tên</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên câu hỏi" value="{item[name]}">
  </div>


  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questiontype/index}">Quay lại</a>
</form>
<?php 
$editValidator = json_encode(pzk_app()->controller->editValidator);
?>
<script>
$('#questionsEditForm').validate({editValidator});
</script>