<?php
$controller = pzk_controller();
$time = time();
$username = pzk_session('username');
if(!$username) $username = 'ongkien';
$token = md5($time.$username . 'onghuu');
?>

<form enctype="multipart/form-data" method="post" action="/import.php?token={token}&time={time}">
    <div class="form-group clearfix">
        <label for="{field[index]}">Chọn file</label>
        <input name="file" type="file"/>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Cập nhật</button>
        <a class="btn btn-default" href="{url /admin}_{controller.module}/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
    </div>
</form>