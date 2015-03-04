<?php
								$username= pzk_session('username');
								$id=$data->getInfo($username);
								pzk_session('id',$id['id']);
?>



<strong><center>Hỏi đáp nhanh</strong>

<div class="comments-wrapper" >

		<div class="Showcomments" align="center" style="margin:0px; float:left; line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px; width:224px; height:auto;">
			<?php $allquestions=$data->getQuestion(); ?>
			{each $allquestions as $allquestion}
			<div style="clear:both;"></div>	
			<div style="float:left; margin: 5px;">
			{allquestion[name]}:{allquestion[question]}
			</div>	
			<div id="spoiler" style="display: none;">
			<?php $count=$data->getCountComment($newsid); ?>
Nội dung của bạn ở đây, có thể chèn mã HTML vào trong này nhé!
</div>
<button onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}" title="Click to show/hide" type="button">Trả lời</button>
			{/each}
		</div>
		
</div>







<form role="form" method="post" action="/AQs/questionPost">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <input type="text" style="height:60px;" class="form-control" id="question" name="question" placeholder="
	<?php if(pzk_session('login')){
	echo"Mời bạn đặt câu hỏi";
	}else{
	echo "Bạn chưa đăng nhập, đăng nhập để gửi câu hỏi";	
	}
	?>" >
	<button type="submit" class="btn btn-primary comment-button">Gửi</button>
  </div>
  
  </form>