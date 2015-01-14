<?php
$controller = pzk_request('controller');
$setting = pzk_controller();
?>
<h2>Menu</h2>
<ul class="nav nav-pills nav-stacked">
  <li><a href="{url /}{controller}/index">Danh sách</a></li>
  <li><a href="{url /}{controller}/add">Thêm mới</a></li>
  <?php
  if(!empty($setting->menuLinks)) {
      foreach($setting->menuLinks as $val) {
  ?>
      <li><a href="{val[href]}">{val[name]}</a></li>
  <?php
      }
  }
  ?>
</ul>