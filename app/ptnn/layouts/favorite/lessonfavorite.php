<div id="lesson_favorite">
<div class="lesson_favorite_">
  <div class="fvr_title"><span class="glyphicon glyphicon-star"></span><span> Danh sách những bài học yêu thích</span></div>
  <div class="prf_clear"></div>
  <div style="margin:auto;text-align:center;"><img src="/3rdparty/uploads/img/circle.png" alt="" width="500px" height="30px"></div>
  <div class="clear" style="padding-bottom:10px;"></div>
  <div class="lesson_favorite_list">
   <div class="list_lesson_favorite">
   
     <div class="lesson_name">Tên bài học</div>
     <div class="lesson_type">Thể loại</div>
     <div class="lesson_type">Thời gian</div>
     <div class="lesson_del">Xóa</div>
  
   </div>
  <?php 
    $member=pzk_request('member');
    $listlessions=$data->viewListLesson($member);
    //var_dump($listlessions);
    //die();
   ?>
   {each $listlessions as $listlession} 
  <div class="list_lesson_row">
   
     <div class="lesson_name_row">{listlession[lessonName]}</div>
     <div class="lesson_type_row">{listlession[categoriesName]}</div>
     <div class="lesson_type_row">{listlession[date]}</div>
     <?php $id=$listlession['id']; ?>
     <div class="lesson_del_row"><a href="/favorite/delLessionfavorite/<?=$id?>" class="{listlession[id]}" onclick="return confirm('are you sure?')">Xóa</a></div>
  
  </div>
  {/each}
 </div>
 </div>
</div> 