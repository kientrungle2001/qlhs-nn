
 

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
      height: 150px;
      margin-left:45px;  
      margin-right:30px; 
      border:1px dotted #FF7357;
     

  }
   .invitation_user
  {
      margin-top:20px;  
      width:80%;
      height: 150px;
      margin-left:45px;  
      margin-right:30px; 
      border:1px dotted #FF7357;
      

  }
  .avata
  {
      margin-top:20px;  
      width:50%;
      height: 100px;
      border:1px dotted #FF7357 
  }
  .title
  {
    
      width:100%;
      height: 50px;
       
      border:1px dotted #FF7357;
  }
</style>
<?php 
$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',pzk_session('username')))->result_one();
?>
<div id="profileuser" >

     <div class="profile_user" style="height: 50px;">
       <p align="center" style=" padding-top: 10px;"> Bạn có lời mời kết bạn</p>
     </div>
     <div class="profile_user" >

     <div style="float:left; padding-top: 20px;padding-bottom: 20px;padding-left: 20px;">
       <img src="<?php echo $items['avata']; ?>"alt="" width="100px" height="100px"> 
     </div>
     <div>
       <p align="center"> <strong >xin chào <?php echo pzk_session('name'); ?></strong></p>
     </div>
        
     </div>
     <div class="profile_user" >
        <table>
          <tr>
            
            <td ><a href="editinfor">Chỉnh sửa thông tin cá nhân</a></td>
          </tr>
          <tr>
            <td >
              <a href="editavata">Thay đổi avata</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="editsign">Thay đổi chữ ký</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="editpassword">Thay đổi mật khẩu</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="editinfor">Thay đổi thông tin cá nhân</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="payment/payment">Nạp Tiền</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="logout">Thoát</a>
            </td>
          </tr>
        </table>
     </div>
     <div class="profile_user" style="height: 600px;">
       <div class="title">
         <p align="center" style=" padding-top: 10px;">Danh sách bạn bè</p>
       </div>
       
       <div class="title" style="height: 450px;">
      <?php 
          $userfriend= _db()->useCB()->select('userfriend')->from('friend')->where(array('equal','username',pzk_session('username')))->result();
          foreach ($userfriend as &$item) { ?>
        <div style="clear: both;">  
        <div style="float:left; padding-top: 20px;padding-bottom: 20px;padding-left: 20px;">
            <img src="<?php echo $items['avata']; ?>"alt="" width="100px" height="100px"> 
        </div>
        <div>
            <p align="center"> <strong >xin chào <?php echo $item['userfriend']; ?></strong></p>
        </div>
        </div>    
        <?php  } ?> 
        <div style="float:right;clear: both;">
          <a href="#">Xem hết >></a>
        </div> 
       </div>
       <div class="title">
          <form method="post" action="/User/searchPost" >
            <input style="width: 200px;"type="text" name="searchfriend"placeholder="Tìm kiếm bạn bè" id="searchfriend" value="">
            <button type="submit" class="login-button">Tìm kiếm</button>
          </form>
       </div>
     </div>              
        
 </div> 
                