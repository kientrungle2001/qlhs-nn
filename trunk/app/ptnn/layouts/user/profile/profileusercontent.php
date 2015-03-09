
<div id="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân</div>
    <div class="prf_note">
      <?php 

        $member= pzk_request('member');
       
        $notes=$data->loadNote($member);

      ?>
      {each $notes as $note}
     <div>
      <div style="float:left;">
        <img src="/3rdparty/uploads/img/usernote.png" alt="">
      </div>
    <div class="prf_titlenote">
    <a href="/note/detailnote?member=<?php echo $member ?>&id={note[id]}">{note[titlenote]}</a>
        
      </div>

      <div class="prf_clear"> </div>
       
      </div>
      {/each}
       
     
            <div class="pr_bt_viewmore_c">
        <a href="/note/viewnote?member=<?php echo $member; ?>">Xem tất cả</a>
      </div>
      
    </div>
          
    <div class="prf_clear" style="width: 100%; height: 60px;"></div>
    <div class="prf_title" style="width:30%; margin-bottom: 30px;">Viết lên tường</div>

    
    <div class="prf_clear" style="width: 100%; height: 50px; margin-bottom: 100px;">
      <textarea id="pr_post_wall" style="border:1px solid #cecece; min-height:110px;width:100%;" required="required" placeholder="Nhập nội dung... (Nội dung ít nhất 10 kí tự)" rel="false"></textarea>
      <input type="button" id="prfwrite_wall" name="send" value="Gửi">
      <?php
       
        $datetime= date("Y-m-d H:i:s");
        $loaduserid= $data->loadUserName($member);
        $username= $loaduserid['username'];

      ?>
      <script>
       
      
       $('#prfwrite_wall').click(function()
        {
        	
          var write_wall= $('#pr_post_wall').val();
          var avatar1='<?php echo pzk_session('avatar'); ?>';
          var userwritewall= '<?php echo pzk_session('username'); ?>';
          var username= '<?php echo $username; ?>';
          var datetime= '<?php echo $datetime ?>';
          $.ajax({
            url:'../note/PostCommentFriend',
            data:{
              username: username,
              write_wall:write_wall }, 
            success:function(result){
            if(result !=""){
            	alert(result);
            }else{

            	 $('#prf_comment_wall div:eq(0)').before('<div><div class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;"><a href="/profile/profilefriend?member='+username+'">'+username+'</a></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;">'+write_wall+' </div><div class="prf_titlenote">'+datetime+' </div><div class="prf_clear"> </div></div></div>');
            }
     
            }
          });

        
        });
      </script>
    </div>
    
    <div id="prf_comment_wall" class="prf_note" style="margin-bottom: 50px;">
        <?php

        $write_walls=$data->loadWriteWall($member);

      ?>
      {each $write_walls as $write_wall}
      <?php 
         $username=$write_wall['userwritewall'];
         $loadUserID = $data->loadUserID($username);
       ?>
    <div>
    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="<?php 
        if($loadUserID['avatar']==''){
          echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ; 
        }else{
          echo $loadUserID['avatar'];
        }
        ?>" alt="" width="60" height="60">
      </div>
      <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
       <a href="/profile/profileusercontent?member=<?php echo $loadUserID['userid']; ?>" >{write_wall[userwritewall]}</a>
         
      </div>
      <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
        {write_wall[content]}    
       </div>
      <div class="prf_titlenote">
        {write_wall[datewrite]}   
      </div>
      <div class="prf_clear"> </div>
       
      </div>
    </div>
    {/each}
           
            <div class="pr_bt_viewmore_c">
        <a href="/wall/viewwritewall?member=<?php echo $member; ?>">Xem tất cả</a>
      </div>
      
    </div>

  </div>