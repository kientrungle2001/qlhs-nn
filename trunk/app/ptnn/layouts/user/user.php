
<style>
  .menu
{
  width:100%; 
  height:30px; 
  line-height:30px;
  margin:0 auto;
}
.menu li
{
  
  display:inline-block;
  width:100%;
}
.menu li ul
{
  position:absolute; 
  display:none;
}
.menu li:hover > ul
{
  display:block;
}
.menu a
{
  display:block; 
  color:black;
  background:#ffff00;
}
.menu ul ul,
.menu li:hover > a,
.menu a:hover
{
  opacity:.8;
}
</style>
<div id="user" style="padding-right: 50px;padding-button: 50px;">
<?php
    if(pzk_session('login')){

    
   ?>

<div class="menu">
<ul>
  <li> <a href="/user/profileuser"><?php echo "Xin chào: ". pzk_session('username');     ?></a>
  <ul>
    <li>Tài khoản hiện có :</li>
    <li><a href="user/editinfor">Sửa thông tin cá nhân</a></li>
    <li><a href="user/payment">Nạp tiền</a></li>
     <li><a href="user/logout">Thoát</a></li>
  </ul>
  </li>
</ul>
  
</div>


<?php } else{  ?>
<form method="post" action="/User/loginPost" >
  
    <input style="width: 120px;" type="text" name="login" size="10px" id="login"placeholder="Username" value="">
    <input style="width: 120px;"type="password" name="passwordlogin"placeholder="Password" id="password" value="">
    <button type="submit" class="login-button">Đăng nhập</button>
    <a href="/user/register">Đăng ký</a>
   
</form>
  <?php } ?>
  </div>