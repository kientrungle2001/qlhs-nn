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
  height: 400px;
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
  height: 30px;
  
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
      <div class="prf_content" style="background-color:#F0FFFF;"> Ngày sinh: <strong><?php echo $user->getBirthday(); ?> </strong> </div>
      <div class="prf_content" style="background-color:#FFF8DC;"> Giới tính: <strong><?php echo $user->getSex(); ?></strong></div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Điểm thành tích:  </div>
      <div class="prf_content" style="background-color:#FFF8DC;"> Sổ học bạ:</div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Tham gia được:  </div>
      <div class="prf_content" style="background-color:#FFF8DC;"><a href="#">Xem thông tin cá nhân</a></div>
      <div class="prf_clear"></div>
    </div>

    <div class="prf_profile" style="margin-top: 20px;">
      <div class="prf_title">BÀI HỌC CỦA THÀNH VIÊN</div>
      <div class="prf_content"><a href="">Bài học yêu thích</a> </div>
      <div class="prf_content"> <a href="">Điểm thành tích</a> </div>
      <div class="prf_content"> <a href="">Thành viên theo dõi</a> </div>
      <div class="prf_content"> <a href="">Về trang của tôi</a> </div>
      <div class="prf_clear"></div>
    </div>
  </div>


  <div id="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>
    <div class="prf_title" style="width:30%;">Ghi chép cá nhân</div>
    <div class="prf_clear" style="width: 100%; height: 60px;"></div>
    <div class="prf_title" style="width:30%;">Viết lên tường</div>
    <div class="prf_clear" style="width: 100%; height: 6  0px;"></div>
    <div class="prf_clear" style="width: 100%; height: 50px;">
      <textarea id="pr_post_wall" style="border:1px solid #cecece; min-height:110px;width:100%;" rel="false">Nhập nội dung... (Nội dung ít nhất 10 kí tự)</textarea>
      <input type="submit" name="send" value="Gửi">
    </div>
  </div>
</div>