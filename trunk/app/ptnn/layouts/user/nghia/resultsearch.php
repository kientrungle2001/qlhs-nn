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
        $searchfriend='%'.$data->getTxtsearch().'%';
    
        //$searchfriend='%nghia%';
        $items_name=_db()->useCB()->select('user.*')->from('user')->where(array('or',array('like','email',$searchfriend),array('like','name',$searchfriend),array('like','username',$searchfriend)))->result();
        if($items_name){
          //var_dump($items_name)  ;
          $find=array();
          foreach ($items_name as $items) {
            $find[$items['username']]=$items;
          }
          //var_dump($find);
          $items_friend=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',pzk_session('username')))->result();
           $friend=array();
          foreach ($items_friend as $items) {
            $friend[$items['userfriend']]=$items;
          }
          //var_dump($friend);
          $items_invitation=_db()->useCB()->select('invitation.*')->from('invitation')->where(array('username',pzk_session('username')))->result();
           $invitation=array();
          foreach ($items_invitation as $items) {
            $invitation[$items['userinvitation']]=$items;
          }
          //var_dump($invitation);
        foreach ($items_name as $items) { 
          
      ?>
      <div>
        <div class="div1">
          <div style="float:left;width:50%;">

            <img src="<?php if($items['avatar'] !="")echo $items['avatar'];else echo BASE_URL."/3rdparty/uploads/img/noavatar.gif"; ?>" width="125px" height="125px">
          </div>
          <div style="float:left;width:50%;">
            <a href="#"><?php echo $items['name']; ?></a>
            <?php 
            
            if(isset($friend[$items['username']]))
              {
            ?>
            <p><a href="/user/invitation?user=<?php echo $items['id']; ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Hủy kết bạn"></a> </p>
            <?php  }

              elseif(isset($invitation[$items['username']]))
              {
            ?>
            <p><a href="#"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/send_email_user_alternative.png' ; ?>" alt="Đã gửi lời mời kết bạn"></a> </p>
            <?php  }
              else
              { ?>
                <p><a href="/user/invitation?user=<?php echo $items['id']; ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a> </p>
            <?php  
              }
          
             ?>
            
          </div>
        </div>
        
      </div>
        <?php 
        }
      }
        ?>
 </div>