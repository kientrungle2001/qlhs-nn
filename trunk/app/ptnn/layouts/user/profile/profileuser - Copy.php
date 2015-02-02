
<?php 
  // Load user
  $request=pzk_element('request');
  $member= $request->get('member');
  if(!$member){
    $member=pzk_session('userId');
  }
  $user= $data->loadUser($member);
  $username=$user['username'];
  $countInvi= $data->countInvitation($member);

?>
<div id="profileuser" >

     <div id="invitation" class="profile_user" style="height: 50px;">
       <p align="center" style=" padding-top: 10px;"> Bạn có <a href="/invitation/listinvitation"><?php echo $countInvi['invi']; ?> lời mời kết bạn</a></p>
     </div>
     
     <div id="avatar_user" class="profile_user" >
  
     <div class="avatar">
       <img src="<?php echo $user['avatar']; ?>"alt="" width="100px" height="100px"> 
     </div>
     <div>
       <p align="center"> <strong >xin chào <?php echo $user['username'];?></strong></p>
     </div>
        
     </div>
     <script>
     var member='<?php echo $member; ?>';
     var sessionId='<?php echo pzk_session('userId'); ?>';
     $(document).ready(function(){
        if(member != sessionId){
          $('#avatar_user').remove();
          $('#invitation').remove();
          $('#prf_manager').remove();
        }
     });
     
     </script>
     <div id="prf_manager" class="profile_user" >
        <table>
          <tr>
            
            <td ><a href="/profile/editinfor">Chỉnh sửa thông tin cá nhân</a></td>
          </tr>
          <tr>
            <td >
              <a href="/profile/editavatar">Thay đổi avatar</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/profile/editsign">Thay đổi chữ ký</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/profile/editpassword">Thay đổi mật khẩu</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/payment/payment">Nạp Tiền</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/account/logout">Thoát</a>
            </td>
          </tr>
        </table>
     </div>
     <?php $friend=$data->countFriend($member); ?>
     <div class="profile_user" style="height: 600px;">
       <div class="title">
         <p align="center" style=" padding-top: 10px;">Danh sách bạn bè ( có <?php echo $friend['friend'] ?> bạn )</p>
       </div>
       
       <div class="title" style="height: 450px;">
      <?php 
          $friend= $data->loadFriendUser($member);
          foreach ($friend as $items) { 
           $userfriend=$items['userfriend'];
           $loadUsernameId= $data->loadUserID($userfriend);
           $loadUserfriendId= $data->loadUserID($userfriend);
           
      ?>
        <div style="clear: both;"> 
        
        <div class="avatarfriend" >
            <img src="<?php if($loadUsernameId['avatar']==''){
              echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ;
            }else echo $loadUsernameId['avatar'];
             ?>"alt="" width="80px" height="80px"> 
        </div>
        <div>
            <p align="center"><a href="/profile/profileusercontent?member=<?php echo $loadUserfriendId['userid'] ?> "> <strong ><?php echo $items['userfriend']; ?></strong></a></p>
        </div>
        </div>    
        <?php 
         }  

         //$loadUsernameId= $data->loadUserID($username);
         ?> 
        <div style="float:right;clear: both;">
          <a href="/friend/friendlistuser?member=<?php echo $member; ?>">Xem hết >></a>
        </div> 
       </div>
       <div class="title">
          <form method="post" action="/friend/searchPost" >
            <input style="width: 200px;"type="text" name="searchfriend"placeholder="Tìm kiếm bạn bè" id="searchfriend" value="">
            <button type="submit" class="login-button">Tìm kiếm</button>
          </form>
       </div>
     </div>              
        
 </div> 
                