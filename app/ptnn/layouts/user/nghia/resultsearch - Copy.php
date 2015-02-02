 <div class="title" style="height: 600px;">
      <?php 
        $searchfriend='%'.$data->getTxtsearch().'%';
    
        //$searchfriend='%nghia%';
        $items_name=_db()->useCB()->select('user.*')->from('user')->where(array('or',array('like','email',$searchfriend),array('like','name',$searchfriend),array('like','username',$searchfriend)))->result();
        if($items_name){

        foreach ($items_name as $items) { 
            
      ?>





      
        <div style="clear: both;">  
        <div style="float:left; padding-top: 20px;padding-bottom: 20px;padding-left: 20px;">
            <img src="<?php echo $items['avata']; ?>"alt="" width="80px" height="80px"> 
        </div >
        <div style="padding-top: 20px;padding-bottom: 20px;">
           <?php echo $items['name']; ?>
            <p><a href="/user/invitation?user=<?php echo $items['id']; ?>"><img src="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/3rdparty/uploads/img/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a> </p>
        </div>
        </div>    
        <?php 
         } 

        
         ?> 
        <div style="float:right;clear: both;">
          <a href="#">Xem hết >></a>
        </div> 
        <?php }else { ?>
       <div style="float:left;clear: both;">
          <p><strong> không có user nào như bạn tìm kiếm</strong></p>
        </div> 
        <?php } ?>
 </div>