
 

<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css">
<style>
  #prf_user_search
  {
  width: 70%;
  height: 170px;
  
  float: left;
  padding-bottom: 20px;

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
  .avata
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
</style>

<div id="prf_user_search" >

     <div class="profile_user" style="height: 100px;">
       <div class="title" style="height: 100px;">
         <p align="center" style=" padding-top: 10px;"><strong>Tìm kiếm bạn bè</strong></p>
         <form action="/Friend/searchPost/" method="get">
         <label for="">Nhập chuỗi cần tìm:</label>
           <input style="width: 250px;height: 30px;" type="text" name="searchfriend" value="">
           <input id="btt_search_user" style="width: 50px;" type="submit" name="submit_search"value="Tìm">
         </form>
       </div>
      
      
       
     </div>              
        
 </div> 
                