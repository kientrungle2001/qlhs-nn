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
   
    <head>
 
  <link rel="stylesheet" media="screen" href="screen.css">
  <style>
      label{
          float: left;
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
  <script src="../../qlhs/3rdparty/Validate/lib/jquery.js"></script>
  <script src="../../qlhs/3rdparty/Validate/dist/jquery.validate.js"></script>
  <script>
  $(function() {
    // highlight
    var elements = $("input[type!='submit'], textarea, select");
    elements.focus(function() {
      $(this).parents('li').addClass('highlight');
    });
    elements.blur(function() {
      $(this).parents('li').removeClass('highlight');
    });

    $("#forgotpassword").click(function() {
      $("#password").removeClass("required");
      $("#login").submit();
      $("#password").addClass("required");
      return false;
    });

    $("#login").validate()
  });
  </script>
</head>
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