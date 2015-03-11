<link rel="stylesheet" href="/default/skin/ptnn/css/question/fill.css">
<?php 
	$categoryIds= pzk_request()->getSegment(3);
	$quantity=6;
	$level=1;
	$items=$data->ShowQestion($level,$categoryIds,$quantity);
	$i=0;
 ?>
 <div class="view_question" id="ctg_question_fill">
 <form role="form" id="frm_question_fill" method="post" action="/Fill/fillPost">
 <div  class="title_question">ĐIỀN TỪ THÍCH HỢP VÀO CHỖ TRỐNG</div>
 	{each $items as $item}
 	<?php $i=$i+1; ?>
 	<div class="step">
 		<span><strong>Yêu Cầu:</strong> {item[request]}</span>

 	</div>
 	<div class="step">
 	<span><strong> Câu {i}:</strong> {item[name]}</span>
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
 	 {/each}
 	 <div class="toeic_footer">
 	 	<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Quay lại</button>
 	 	<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-forward"></span> Tiếp </button>
 	 </div>
	<div >
		<button type="submit" class="btn btn-primary" onclick="hoanthanh(); return false;" ><span class="glyphicon glyphicon-save"></span> Hoàn Thành</button>
		<button id="btt_off" type="submit" class="btn btn-primary"  ><span class="glyphicon glyphicon-save"></span> Xem Đáp Án</button>
		<button type="submit" class="btn btn-primary"  ><span class="glyphicon glyphicon-save"></span> Lưu vào vở bài tập</button>
		<button type="submit" class="btn btn-primary"  ><span class="glyphicon glyphicon-save"></span> Gửi giáo viên chấm</button>
			
	</div>
	
 </form>
 </div>
 <script>
 	function addInputRow(key){
		
		var div = document.createElement('div');

	    div.className = 'col-xs-3 margin-top-10 element-input';
		
	    div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answers['+key+'][]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	   	$('.itemAnswer_'+key).append(div);
	}
	function hoanthanh() {
		$('input[type=text]').prop( "disabled", true );
		$('.remove-input').hide();
		$('.btt_add_answer').hide();
		var formdata = $('#frm_question_fill').serializeForm();
		//console.log(formdata['answers'][1][0]);
		for(var key in formdata['answers']) {
			var value = formdata['answers'][key];
			for(var key2 in value) {
				var value2 = value[key2];
				console.log(value2);
			}
		}

		return formdata;
	}
	$("#ctg_question_fill").on("click", '.remove-input', function(e){
		 $(this).parent().remove();
	});
 </script>