<?php
$controller = pzk_controller();
$sendallFieldSettings = $controller->sendallFieldSettings;
?>
<form role="form" method="post" action="{url /admin_newletter/sendallPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Ti�u d?</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Nh?p ti�u d?" >
  </div>
  <div class="form-group">
    <label for="brief">N?i dung</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Nh?p n?i dung" >
  </div>
  <button type="submit" class="btn btn-primary">G?i thu</button>
  <a href="{url /admin_newletter/index}">Quay l?i</a>
	</form>