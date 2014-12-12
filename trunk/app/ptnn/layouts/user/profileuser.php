
 

<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css">
<style>
  #profileuser
  {
      border-width: 1px;
      border-style: solid;
      border-color: #FF7357;
      width:100%; 
      height: auto;
      display: block;
  }
  .profile_user
  {
      margin-top:20px;  
      width:80%;
      margin-left:45px;  
      margin-right:30px; 
      border:1px dotted #FF7357 
  }
  .avata
  {
      margin-top:20px;  
      width:50%;
      height: 100px;
      border:1px dotted #FF7357 
  }
</style>
<div id="profileuser" > 
     <div class="profile_user" >
        <p align="center"> <strong >xin chào <?php echo pzk_session('name'); ?></strong></p>
     </div>
     <div class="profile_user" >
        <table>
          <tr>
            
            <td align="center">Chỉnh sửa thông tin cá nhân</td>
          </tr>
          <tr>
            <td align="center">
              <a href="editsign">Thay đổi chữ ký</a>
            </td>
          </tr>
          <tr>
            <td align="center">
              <a href="editpassword">Thay đổi mật khẩu</a>
            </td>
          </tr>
          <tr>
            <td align="center">
              <a href="editinfor">Thay đổi thông tin cá nhân</a>
            </td>
          </tr>
        </table>
     </div>              
        
 </div> 
                