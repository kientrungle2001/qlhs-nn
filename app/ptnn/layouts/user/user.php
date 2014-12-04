<div style="height: 50px;
  padding-right: 25px;">

<?php    if(pzk_session('login')){ ?>
      <a href="user/editinfor">

  <?php  echo pzk_session('username');   ?></a>

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