  <style>
  
  .div1
  {
    width: 33.3%;
    float: left;
    height: 130px;
    border:1px dotted #FF7357;
  }
 </style>
 <div class="listinvitation" >
      <?php 
        $items=$data->viewListInvitation();
       
      ?>
      {each $items as $item}
      <?php 
        $userfriend=$item['userfriend'];
        $user=$data->loadUserId($userfriend);
        $avatar=$user['avatar'];
        
        $userid=$user['userid'];

        $name=$user['name'];
        $testAvatar=$data->testAvatar($avatar);
        $testOnline=$data->testOnline($userid);
        
     ?>
     <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="{testAvatar}" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
        <div>
          <a href="/user/profileusercontent?member={userid}" ><span>Tên: {name}</span></a>
        </div>
        <div>
          <a href="/user/profileusercontent?member={userid}" ><span>Nickname: {userfriend}</span</a>
        </div>
        <div>
          <span>Bài viết: 0   |   Tham gia:ngày</span>
        </div>
        <div>
          <span><a href="{url /user/agree}?userinvitation={items[username]}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a></span>
          <span><a href="/user/denyfriend?member={userid}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a></span>
        </div>
      </div>
       
      <div class="result_search_mark" >
        <div>
          <span>• Danh hiệu:</span>
        </div>
        <div>
          <span>• Điểm thành tích:</span>
        </div> 
        <div>
          <span>• Sổ học bạ:</span>
        </div>
        <div>
          <span>• Điểm học bạ:</span>
        </div>
        
      </div>
      <div class="prf_clear"> </div>
       
      </div>
  {/each}
    
    </div>







      <div>
        <div class="div1">
          <div style="float:left;width:50%;">

            <img src="<?php  echo BASE_URL."/3rdparty/uploads/img/noavatar.gif"; ?>" width="125px" height="125px">
          </div>
          <div style="float:left;width:50%;">
            <a href="#">{items[username]}</a>
            <p><a href="{url /user/agree}?userinvitation={items[username]}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a>
              <a href="{url /user/deny}?userinvitation={items[username]}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Hủy Kết bạn"></a>
             </p>
          </div>
        </div>
        
      </div>
        <?php 
        }
      }
        ?>
 </div>