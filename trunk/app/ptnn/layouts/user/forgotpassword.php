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
    <p align="center"><strong> Lấy lại mật khẩu mới</strong></p>
    </div> 
    <form method="post" action="/User/forgotpasswordPost" >
    
      <?php 
        echo @$data->getError();
       $request = pzk_element('request');
       ?>
     <br> 
     <p>Bạn hãy điền địa chỉ email của bạn vào ô bên dưới, một mật khẩu mới sẽ được gửi đến mail của bạn, sau khi xác nhận mật khẩu mới thành công bạn có thể đăng nhập vào bình thường.</p>
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" value="<?php echo $request->get('email') ;  ?>">
      
      <br>

    
      <label for="captcha">Mã bảo mật:</label>
      <input type="captcha" name="captcha" id="captcha" value="">
      
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="login-button">Đồng ý</button>
   
  </form>
  </div>