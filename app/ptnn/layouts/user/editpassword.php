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
    <p align="center"><strong> Thay đổi mật khẩu</strong></p>
    </div> 
    <form method="post" action="/User/editpasswordPost" >
    
      <?php 
        echo @$data->getError();
       $request = pzk_element('request');
       ?>
     <br> 
     <p>Để thay đổi mật khẩu bạn vui lòng điền đầy đủ các thông tin bên dưới</p>
      <label for="oldpassword">Mật khẩu cũ:</label>
      <input type="password" name="oldpassword" id="oldpassword" value="<?php echo $request->get('oldpassword') ;  ?>">
      
      <br>

    
      <label for="newpassword">Mật khẩu mới:</label>
      <input type="password" name="newpassword" id="newpassword" value="<?php echo $request->get('newpassword') ;  ?>">
      
      <br>
      <label for="renewpassword">Xác nhận mật khẩu mới:</label>
      <input type="password" name="renewpassword" id="renewpassword" value="">
      
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="editpassword-button">Đồng ý</button>
   
  </form>
  </div>