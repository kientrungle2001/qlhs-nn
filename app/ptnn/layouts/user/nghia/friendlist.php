 <style>
  .resulsearch
  {
    width: 99.9%;
    float: left;
    height: auto;
   
  }
  .div1
  {
    width: 33.3%;
    float: left;
    height: 130px;
    border:1px dotted #FF7357;
  }
 </style>
 <div style="clear:both;"></div>
 <div class="resulsearch" style="height: 100px;">
      <?php 
        $friend = _db()->select('user.*, friend.*')->from('user')->join('friend', 'user.username = friend.username', 'left')->result();
        //$friend=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',pzk_session('username')))->result();
        if($friend){

        foreach ($friend as $items) { 
            
      ?>
      <div>
        <div class="div1">
          <div style="float:left;width:50%;">

            <img src="<?php  echo BASE_URL."/3rdparty/uploads/img/noavatar.gif"; ?>" width="125px" height="125px">
          </div>
          <div style="float:left;width:50%;">
            <a href="#"><?php echo $items['userfriend']; ?></a>
            <p><a href="/user/denyfriend?userfriend=<?php echo $items['userfriend']; ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a> </p>
          </div>
        </div>
        
      </div>
        <?php 
        }
      }
        ?>
 </div>