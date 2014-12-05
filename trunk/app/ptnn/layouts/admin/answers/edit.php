<?php $item = $data->getItem(); ?>
<form role="form" method="post" action="{url /admin_answers/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <input type="hidden" name="questionId" value="{item[questionId]}" />
  <div class="form-group">
    <label for="value">Câu trả lời</label>
    <input type="text" class="form-control" id="value" name="value" placeholder="Câu trả lời" value="{item[value]}">
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questions/detail}/{item[questionId]}">Quay lại</a>
</form>