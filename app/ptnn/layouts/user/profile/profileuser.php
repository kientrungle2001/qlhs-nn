
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
  $avatar=$data->testAvatar($member);
?>
<div id="profileuser">
  <div class="infor_user">
    
      <div class="infor_user1" ><span style="font-size:35px;" class="glyphicon glyphicon-star"></span></div>
      <div class="infor_user2">
        <span>{user[username]}</span>
      </div>
   
    <div class="avatar_user">
      <img style="border-radius:10%" src="{avatar}" alt="" width="115px" height="115px">
    </div>
    <div class="clear"></div>
    <div class="line"><span class="text_infor_user"><strong>Sinh nhật:</strong> {user[birthday]}</span></div>
    <div class="line"><span class="text_infor_user"><strong>Địa chỉ:</strong> {user[address]}</span></div>
    <div class="line"><span class="text_infor_user"><strong>Biểu đồ phát triển</strong></span></div>
    <div class="grow_map"> </div>
  </div>
  <div class="tamp"></div>


  <div class="notebook">
    <div class="prf_text_title" style="padding-left:10px;">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Vở bài tập</span>
    </div>
    <div class="prf_img"> <img src="/3rdparty/uploads/img/address_book.ico" alt="" width="100px" height="100px"></div>
  </div>
  <div class="tamp"></div>

   <?php $friend=$data->countFriend($member); ?>
  <div class="friend_list">
    <div class="prf_friend_title">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Danh sách bạn bè</span><br>
      <span class="count_friend">(Có {friend} bạn bè)</span>
    </div>
    <?php 
          $friend= $data->loadFriendUser($member);
          foreach ($friend as $items) { 
           $userfriend=$items['userfriend'];
          // $loadUsernameId= $data->loadUserID($userfriend);
           $loadfriend= $data->loadUserID($userfriend);
           $avatar_friend=$data->testAvatar($loadfriend['userid']);
      ?>
    <div class="prf_friend">
      <div class="prf_avatar_friend">
        <a href="/profile/profileusercontent?member={loadfriend[userid]}">
          <img style="border-radius:6%" src="{avatar_friend}" alt="" width="60px" height="60px">
        </a>
        
      </div>
      <div class="prf_name_friend">
      <a href="/profile/profileusercontent?member={loadfriend[userid]}">{userfriend}</a>
      </div>
    </div>
    <?php } ?>
    
    <div class="prf_friend_more">
      <div style=" float:right;"><a style="color: #fefeff;" href="/friend/friendlistuser?member={member}">Xem tiếp >></a></div>
    </div>
  </div>
  <div class="tamp"></div>



  <div class="learning_user">
    <div class="prf_text_title" style="padding-left:10px; height:40px;" >
      <span style="color:#ed008c;" class="glyphicon glyphicon-heart-empty"></span>
      <span style="color:#802890;" >Góc học tập</span>
    </div>
    <div class="prf_lesson_list">
      <?php echo $data->checkMember($member) ?>
    </div>
    <div class="prf_lesson_list">
      <a class="prf_a" href="/favorite/lessonhistory?member={member}">Lịch sử học tập</a>
    </div>
    <div class="prf_lesson_list">
      <a class="prf_a" href="">Điểm thành tích</a>
    </div>

  </div>
</div>