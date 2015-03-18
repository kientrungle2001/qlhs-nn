<link rel="stylesheet" href="/default/skin/ptnn/css/question/fill.css">
<?php 
	$categoryIds= pzk_request()->getSegment(3);
	$quantity=11;
	$num_row=3;
	$num_page=ceil($quantity/$num_row);
	$level=1;
	$items=$data->ShowQestion($level,$categoryIds,$quantity);
	$questionId=array();
	$questionType=array();


 ?>
 <div class="view_question" id="ctg_question_fill">
 <form role="form" id="frm_question_fill" method="post" action="/Fill/fillPost">
 <div  class="title_question">ĐIỀN TỪ THÍCH HỢP VÀO CHỖ TRỐNG</div>
 <?php 
 	for($j=0;$j< $num_page; $j++){
  ?>
 <div id="frm_answer_box<?=$j+1?>" class="answer_box">
 <?php 
 	for($i=$j*$num_row;$i<$j*$num_row+ $num_row; $i++) {	
 		if($i>=$quantity){
 			break;
 		}
  ?>
 	<div class="step">
 		<span><strong>Yêu Cầu:</strong> <?=$items[$i]['request']?></span>
		
		<input type="hidden" name="question_id[<?=$i;?>]" value="<?php echo $items[$i]['id']; ?>">
		<input type="hidden" name="question_type[<?=$i;?>]" value="<?php echo $items[$i]['type']; ?>">
 	</div>
 	<div class="step">
 	<span><strong> Câu <?=$i+1;?>:</strong> <?=$items[$i]['name']?></span>
  	</div>
	<div class="view_tamp_answers">
	 	<div class="clear"><strong><span>Đáp án mẫu:</span></strong></div>
  		<?php 
  			
  			//$question_id[$i]= $items[$i]['id'];
  			$view_answers= $data->ShowAnswer($items[$i]['id']);
  			$count_answer= count($view_answers);
  			for($k=0; $k<$count_answer; $k++){

  			
  		?>
  		
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
  			<div class="view_tamp_answer"><?=$k+1;?> .
  			<?=$view_answers[$k]['content']; ?></div>
  		</div>
  		<?php } ?>
	</div>	

  	<div class="step" >
  		<div style="clear:both;"><span><strong>Đáp án:</strong></span></div>
  		
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" name="answers[<?=$i;?>][]" class="form-control content_value"/>
			</div>
			<div class="remove-input" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
		</div>
		<div class="add_row_answer">
			<div class="itemAnswer_<?=$i;?>"  ></div>
		</div>
		<div class="btt_add_answer"><button type="button" class="btn btn-primary add-sub-input-test" onclick="addInputRow(<?=$i;?>)" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Thêm đáp án</button></div>
  		
  	</div>
  	<div class="dot">-------------------------------------------------------------------</div>
 	<?php } ?>
 </div>
 <?php } ?>	
 	 <div class="toeic_footer">
 	 	<button type="button" onclick="Back()" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Quay lại</button>
 	 	<button type="button" onclick="Next()" class="btn btn-default"><span class="glyphicon glyphicon-forward"></span> Tiếp </button>
 	 </div>
	<div >
		<button type="submit" id="btt_Fillfinish" class="btn btn-primary" onclick="finish(); return false; " ><span class="glyphicon glyphicon-save"></span> Hoàn Thành</button>
		<button id="btt_off" type="button" class="btn btn-primary" onclick="showAnswer()" ><span class="glyphicon glyphicon-save"></span> Xem Đáp Án</button>
		<button id="btt_save_book" type="button" class="btn btn-primary" onclick="saveBook();" ><span class="glyphicon glyphicon-save"></span> Lưu vào vở bài tập</button>
		<button type="button" class="btn btn-primary"  ><span class="glyphicon glyphicon-save"></span> Gửi giáo viên chấm</button>
			
	</div>
	<input type="hidden" name="quantity_question" value="<?php echo $quantity; ?>">
	<input type="hidden" name="category_id" value="<?php echo $categoryIds; ?>">
 </form>
 </div>
 <script>
 	$('.view_tamp_answers').hide();
 	function showAnswer(){
 		var test= finish();
 		if(test){
 			$('.view_tamp_answers').show();
 		}
 		
 	}
 	function addInputRow(key){
		
		var div = document.createElement('div');

	    div.className = 'col-xs-3 margin-top-10 element-input';
		
	    div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answers['+key+'][]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	   	$('.itemAnswer_'+key).append(div);

	}
 	function viewAnswer(key){
		
		var div = document.createElement('div');

	    div.className = 'col-xs-3 margin-top-10 element-input';
		
	    div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answers['+key+'][]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	   	$('.itemAnswer_'+key).append(div);

	}
  var formdata;

	function finish() {
		
		$('.remove-input').hide();
		$('.btt_add_answer').hide();
		formdata = $('#frm_question_fill').serializeForm();
		$('input[type=text]').prop( "disabled", true );
		$('#btt_Fillfinish').prop( "disabled", true );
		return formdata;
	}


	$("#ctg_question_fill").on("click", '.remove-input', function(e){
		 $(this).parent().remove();
	});




	// phan trang
var currentpage=0;

  function Next()
  {
  	var numpage=<?php echo $num_page ?>;
    if(currentpage < numpage){
    	currentpage++;
    }
    $('.answer_box').removeClass('active');
    $('#frm_answer_box'+currentpage).addClass('active');
   
  }
   function Back()
  {
  	var numpage=<?php echo $num_page ?>;
    if(currentpage >1){
    	currentpage--;
    }
    $('.answer_box').removeClass('active');
    $('#frm_answer_box'+currentpage).addClass('active');
   
  }

  Next();

  // Lưu vào vở bài tập
 
  function saveBook(){
  	if(formdata==null){  		
  		formdata= finish();
  		
  	}
  	$.ajax({
      type: "Post",
      data:{
        
        answers: formdata

      },
      url:'/fill/fillPost',
      success: function(msg){
        if(msg=="1"){
        	$('#btt_save_book').prop( "disabled", true );
        	
        }
        
      }

    });

  }

 </script>