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
  .avatar
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
   .title ul{
	  padding-top:20px; 
   }

</style>

<div id="profileuser" >

    
     <div class="profile_user" style="height: 600px;">
       <div class="title">
         <p align="center" style=" padding-top: 10px;">Danh sách tin tức</p>
       </div>
       
       <div class="title" style="height: 450px;">
<?php 
        $sql="select * from `news` where parent=0";
        $titles= _db()->query($sql);
		foreach ($titles as $title) { 
 ?>
        <div style="clear: both;">  
        <div style="float:left; padding:20px;">
            <img src="<?php echo BASE_URL.'/3rdparty/Filemanager/source/10269461_773590456011613_5268887879935957415_n.jpg' ; ?>"alt="" width="80px" height="80px"> 
        </div>
        <div><ul><strong ><a href="/news/shownews?id=<?php echo $title['id']; ?> "> <?php echo $title['title']; ?></a></strong></ul>
		<?php
			$sql2="select * from `news` where parent=". $title['id'];
			$titles2= _db()->query($sql2);
			
			 foreach ($titles2 as $title2) { 
			 //echo $friend2['title']."<br>";
			 
			?>
		
            <li align="left"><a href="/news/shownews?id=<?php echo $title2['id']; ?> "> <?php echo $title2['title']."<br>"; }?></a></li>
        </div>
        </div> 		
        <?php  }  ?> 
        <div style="float:right;clear: both;">
          <a href="/news/oldnews">Xem thêm >></a>
        </div> 
       </div>
       <div class="title">
          <form method="post" action="/news/searchPost" >
            <input style="width: 200px;"type="text" name="searchfriend"placeholder="Nhập vào từ khóa" id="searchfriend" value="">
            <button type="submit" class="login-button">Tìm kiếm</button>
          </form>
       </div>
     </div>              
        
 </div> 
                