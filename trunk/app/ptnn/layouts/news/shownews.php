<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css">
<style>
#profilefriend
  {
      border-width: 1px;
      border-style: solid;
      border-color: #FF7357;
      width:100%; 
      height: auto;
      display: block;
  }
  .prf_profile
  {  
      width:100%;
      height: auto;
      border:1px dotted #FF7357;
  }
  .prf_member
  {
	  margin-bottom:10px;
      width:100%;
      height: 50px;
      color:green;
      border:1px dotted #FF7357;
  }
  .prf_content
  {
    
      width:100%;
      height: auto;
      border:1px dotted #FF7357;
  }
  .prf_other
  {
  
      width:100%;
      height: 200px;
      border:1px dotted #FF7357;
     

  }
</style>
<?php  
  $id=pzk_request('id');
 $arr=_db()->useCB()->select('*')->from('news')->where(array('id', $id))->result_one();
?>
<div id="profilefriend">
  <div id="profilefriend_left">
    <div class="prf_profile">
      <div class="prf_member">
	  <h4> <?php echo $arr['title']; ?></h4>
	  </div>
      <div class="prf_content"><?php  echo $arr['content']; ?></div>
      <div class="prf_clear"></div>
    </div>
	
    <div class="prf_other" style="margin-top: 20px;">
      <div class="prf_title">Các tin liên quan
	  </div>
	  <?php
			$id=pzk_request('id');
			$parentid=_db()->useCB()->select('parent')->from('news')->where(array('id', $id))->result_one();
			$lists=_db()->useCB()->select('*')->from('news')->where(array('parent', $parentid['parent']))->result();
			foreach ($lists as $list) { 
			?>
      <div class="prf_content"> 
	  <li><a href="/news/shownews?id=<?php echo $list['id']; ?> "><?php echo $list['title']."<br>"; } ?></a></li>
	  </div>
      <div class="prf_clear">
	  <p><a href="/news/news">Quay lại</a></p>
	  </div>
    </div>
  </div>


  <div id="profilefriend_right"></div>
</div>