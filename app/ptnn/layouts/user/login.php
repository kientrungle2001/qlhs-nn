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
      label 
      {
        width:200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
  <script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
  <script>
  $().ready(function() 
  {
   $("#formLogin").validate(
   {
      rules: 
      {
        login: 
        {
          required: true,
          minlength: 6
        },
        passwordlogin: 
        {
          required: true,
          minlength: 6
        },
      },
      messages:
       {
          login: 
          {
             required: "Tên đăng nhập không được bỏ trống",
             minlength: "Tên đăng nhập tối thiểu là 6 ký tự"
          },

           passwordlogin: 
          {
             required: "Mật khẩu không được bỏ trống",
             minlength: "Mật khẩu tối thiểu là 6 ký tự"
          }
        }
    });
  });

  </script>
  <style>
 
    #formLogin label.error {
        
        width: auto;
        display: block;
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
       padding-left:200px;
    }
    </style>
</head>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Đăng Nhập</strong></p>
    </div> 
    <form method="post" id="formLogin" action="/User/loginPost" >
    
      <?php 
        echo @$data->getError();
       $request = pzk_element('request');
       ?>
     <br> 
      <label for="login">Tên đăng nhập:</label>
      <input type="text" name="login" id="login"size="4" value="<?php echo $request->get('login') ;  ?>">
      <a href="/user/register">Tạo tài khoản mới</a>
      <br>

    
      <label for="passwordlogin">Mật khẩu:</label>
      <input type="password" name="password" id="passwordlogin" size="15px" value="">
      <a href="/user/forgotpassword">Quên mật khẩu</a>
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="login-button">Đăng nhập</button>
   
  </form>
  </div>
  <?php 
}
  ?>