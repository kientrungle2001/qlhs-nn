<style>
 #profilefriend
 {
  width: 100%;
  height: 800px;
  
  float: left;
 } 
  #profilefriend_left
 {
  width: 30%;
  height: 800px;
  float: left;
  
 }
  #profilefriend_right
 {
  width: 70%;
  height: 800px;
  
  float: left;
 } 
 .prf_profile
 {
  width: 100%;
  float: left;
 background-color: #E6E6FA;
  height: 300px;
  margin-top: 10px;
 } 
 .prf_title
 {
  width: 100%;
  float: left;
  background-color: #008000;
  height: 30px;
  font-size: 10pt;
  text-align: center;
  color: #fff;
  margin: 10px 0;
 } 
.prf_content
 {
  width: 100%;
  float: left;
  
  height: 50px;
 }
 .prf_clear
 {
  padding-bottom: 20px;
 clear: both;
 color: #57970F;

 } 
 .prf_member
 {
  font-size: 13pt;
  text-align: center;
 
  margin-top: 10px;
 } 
.prf_avatar
 {
  margin-left: 70px;
  margin-right: 30px;
  margin-top: 10px;
  margin-bottom: 10px;
  min-height: 80px;
  max-height: 160px;
  width: 123px;

 } 
</style>
<?php  
  $request=pzk_element('request');
  $user=_db()->getEntity('user.user');
  $user->loadWhere(array('username',$request->get('member')));
 
?>
<div id="profilefriend">
  <div id="profilefriend_left">
    <div class="prf_profile">
      <div class="prf_member"> <?php echo $request->get('member'); ?></div>
      <div class="prf_member">
        <?php 
          if(pzk_session('username')==$request->get('member'))
          {
        ?>
        <img src="<?php echo BASE_URL.'/3rdparty/uploads/img/online.png' ; ?>" alt=""> Online
        <?php    
          }
          else
          { ?>
        <img src=" <?php echo BASE_URL.'/3rdparty/uploads/img/offline.png' ; ?>" alt=""> Offline
          <?php 
          }
         ?>
      </div>
      <div>
       
      </div>
      <div class="prf_avatar">
        <img src=" <?php if($user->getAvatar()=="")
        {
          echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ;
        }else echo $user->getAvatar();
        ?>" alt="avatar" width="100px" height="100px;">
      </div>
      <div class="prf_member">
        <a href="/user/denyfriend?userfriend=<?php echo $user->getUsername(); ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a>
      </div>
      <div class="prf_content">
        
      </div>
      <div class="prf_clear"></div>
    </div>
    <div class="prf_profile" style="margin-top: 20px;">
      <div class="prf_title">THÔNG TIN CÁ NHÂN</div>
      <div class="prf_content"> </div>
      <div class="prf_clear"></div>
    </div>
  </div>


  <div id="profilefriend_right"></div>
</div>