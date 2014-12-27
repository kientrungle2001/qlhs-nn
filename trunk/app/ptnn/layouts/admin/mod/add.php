<?php
    $levels = _db()->select('*')->from('admin_level')->result();
?>
<form id="questionsAddForm" role="form" method="post" action="{url /admin_questions/addPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group clearfix">
    <label for="name">Tên đănng nhập</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Tên đăng nhập" value="{_REQUEST[name]}">
  </div>
    <div class="form-group clearfix">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="name" password="password" placeholder="password" value="{_REQUEST[password]}">
    </div>
    <div class="form-group clearfix">
        <label for="type">Nhóm người dùng</label>
        <select class="form-control" id="type" name="type" placeholder="Loại" value="{item[type]}">
            <option value="">Chọn nhóm người dùng</option>
            {each $levels as $val }
            <option value="{val[id]}">{val[level]}</option>
            {/each}

        </select>
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