<div id="user" style="padding-right: 50px;padding-button: 50px;">
<?php
    if(pzk_session('login')){

    
   ?>
    <?php
      echo "Xin chào: ". pzk_session('username');
      
      ?>
    
      <a href="/user/logout" > đăng xuất </a>

   <?php } else{

    
    
    ?>
<form method="post" action="/User/loginPost" >
  
    <input style="width: 120px;" type="text" name="login" size="10px" id="login"placeholder="Username" value="">
    <input style="width: 120px;"type="password" name="password"placeholder="Password" id="password" value="">
    <button type="submit" class="login-button">Đăng nhập</button>
    <a href="/user/register">Đăng ký</a>
   
  </form>
  <?php } ?>
  </div>