<div id="lesson_history">
  <div class="layout_title">Lịch sử học tập</div>
  <div class="prf_clear"></div>
  <div class="note_favorite">
  <span class="glyphicon glyphicon-star"></span>
  <span> Danh sách những bài đã học</span>
  </div>
  <div class="clear"></div>
  
   <div class="list_lesson_favorite">
   
     <div class="lesson_history_name">Tên bài học</div>
     <div class="lesson_history_type">Thể loại</div>
     <div class="lesson_history_type">Thời gian</div>
     
  
   </div>
  <?php 
    $member=pzk_request('member');

    $listlessions=$data->viewListLesson($member);
    //var_dump($listlessions);
    //die();
   ?>
   {each $listlessions as $listlession} 
  <div class="list_lesson_row">
   
     <div class="lesson_history_name_row"><a href="#">{listlession[lessonName]}</a></div>
     <div class="lesson_history_type_row"><a href="#">{listlession[categoriesName]}</a></div>
     <div class="lesson_history_type_row">{listlession[date]}</div>
     
  
  </div>
  {/each}
 </div>
 