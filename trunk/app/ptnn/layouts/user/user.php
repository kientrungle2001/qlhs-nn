<div style="height: 50px;
  padding-right: 25px;">

<?php
    if(pzk_session('login')){

      echo pzk_session('username');
   ?>

      <a href="user/Login">Đăng xuất
      <?php
        pzk_session('login',false);
      ?></a>

   <?php } else
   {
    ?>
   <a href="/user/Login">Đăng Nhập</a>
      <a href="/User/Register">Đăng Ký</a>  
   <?php }
  ?>
  </div>