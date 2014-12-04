<?php
    if(pzk_session('login')){

    
   ?>
    <?php
      echo pzk_session('username');
      
      ?>
      <br>
      <a href="/user/logout"> đăng xuất </a>

   <?php } else{

    
    
    ?>
   <style>
      label{
          float: left;
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Đăng Nhập</strong></p>
    </div> 
    <form method="post" action="/User/loginPost" >
    
      <?php 
        echo @$data->getError();
       $request = pzk_element('request');
       ?>
     <br> 
      <label for="login">User:</label>
      <input type="text" name="login" id="login" value="<?php echo $request->get('login') ;  ?>">
      <a href="/user/register">Tạo tài khoản mới</a>
      <br>

    
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
      <a href="/user/forgotpassword">Quên mật khẩu</a>
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="login-button">Login</button>
   
  </form>
  </div>
  <?php 
}
  ?>