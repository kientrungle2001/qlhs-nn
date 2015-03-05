<?php
								$username= pzk_session('username');
								$id=$data->getInfo($username);
								pzk_session('id',$id['id']);
?>

<div class="comments-wrapper" style="background-color: #c6e9fc; width:100%;  height: 420px; display: block;">
	<strong><center>Hỏi đáp nhanh</strong>
	<div class="Showcomments" style="  border-radius: 10px; margin: 12px;background: linear-gradient(to bottom right, #fdfeff , #d2f4fe); min-height:300px;overflow:auto;">
		<?php $allquestions=$data->getQuestion();?>
		{each $allquestions as $allquestion}
		<div class="clearfix"></div>	
		<div style="float:left; margin: 5px;">
			{allquestion[name]}:{allquestion[question]}
		</div>	
		<div id="<?=$allquestion['id']?>" style="display: none; position: absolute;">
			<div class="answer-wrapper" style="border-radius: 10px;margin: auto;background: linear-gradient(to bottom right, #fdfeff , #d2f4fe);height:250px; z-index:999;">
				<div class="show-answer" style="height:180px; width:200px; background: linear-gradient(to bottom right, #fdfeff , #d2f4fe); padding: 5px 5px 5px 5px; overflow:auto;">
				<?php 
				$questionid=$allquestion['id'];
				$count=$data->getCountAnswer($allquestion['id']); 
				$allanswers=$data->getAnswer($allquestion['id']);
				?>
				{each $allanswers as $allanswer}
				{allanswer[name]}: {allanswer[answer]}<br>
				{/each}
				</div>
				<form role="form" method="post" action="/AQs/answerPost">
					<input type="hidden" name="id" value=""/>
					<div class="form-group">
						<input type="hidden" id="questionid" name="questionid" value="<?=$allquestion['id']?>" />
						<input type="text"  class="form-control" id="answer" name="answer" placeholder="
						<?php if(pzk_session('login')){
						echo"Trả lời";
						}else{
						echo "Bạn chưa đăng nhập, đăng nhập để gửi câu hỏi";	
						}
						?>" >
						<button type="submit" class="btn btn-primary comment-button">Trả lời</button>
						<button class="btn btn-primary comment-button" onclick="if(document.getElementById('<?=$allquestion['id']?>') .style.display=='none') {document.getElementById('<?=$allquestion['id']?>') .style.display=''}else{document.getElementById('<?=$allquestion['id']?>') .style.display='none'}" type="button">Ẩn</button>
					</div>
				</form>
			</div>
		</div>
		<button onclick="if(document.getElementById('<?=$allquestion['id']?>') .style.display=='none') {document.getElementById('<?=$allquestion['id']?>') .style.display=''}else{document.getElementById('<?=$allquestion['id']?>') .style.display='none'}" type="button">{count} Trả lời</button>
		{/each}
	</div>
	<div class="clearfix" style="padding:5px; height:60px; width:224px;">
		<form role="form" method="post" action="/AQs/questionPost">
			<input type="hidden" name="id" value="" />
			<div class="form-group">
				<input type="text"  class="form-control" id="question" name="question" placeholder="
				<?php if(pzk_session('login')){
				echo"Mời bạn đặt câu hỏi";
				}else{
				echo "Bạn chưa đăng nhập, đăng nhập để gửi câu hỏi";	
				}
				?>" >
				<button type="submit" class="btn btn-primary comment-button">Gửi</button>
			</div>
		  
		 </form>
	 </div>
 </div>