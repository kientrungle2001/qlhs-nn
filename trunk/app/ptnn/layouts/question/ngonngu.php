<?php  
	
	$category = $data->getCategory();

	$data_types = $data->getData_types();
	
	$data_topics = $data->getData_topics();
?>
<div class="guide">
	<!-- Video slide guide -->
</div>

<div class="criteria">
	<?php if(isset($category['child']) && !empty($category['child'])):?>
	<div class="row">
		
		
	</div>
	<?php else:?>
	<div class="criteria-join">
		<div class="row form-group"> 
				<div class="col-xs-4">
					<label for="type"><span class="glyphicon glyphicon-play-circle"></span> Chọn dạng câu hỏi</label>
				</div>	
				<div class="col-xs-offset-4 col-xs-4">
					<select id="type" class="form-control" onchange="" name="type">
						<?php 
							$question_types = trim($category['question_types'],',');
							$question_types_arr = explode(',', $question_types);
							$type_id = $question_types_arr[0];
						?>
						
						<?php foreach($data_types as $key =>$value):?>
						<option class="pd-left-10" value="<?=$value['id']?>" <?php if($type_id == $value['id']):?> selected="1" <?php endif;?> >Dạng <?=$key?> : <?=$value['name']?> </option>
						<?php endforeach;?>
					</select>
				</div> 
		</div>
		<div class="row form-group">
				<div class="col-xs-4">
					<label for="topic"><span class="glyphicon glyphicon-play-circle"></span> Chọn chủ đề</label>
				</div>
				<div class="col-xs-offset-4 col-xs-4">
					<select id="topic" class="form-control" onchange="" name="topic">
						<?php foreach($data_topics as $key =>$value):?>
						<option class="pd-left-10" value="<?=$value['id']?>"> <?=$value['name']?> </option>
						<?php endforeach;?>
					</select>
				</div>
		</div>
	</div>
	<?php endif;?>
</div>

<script>
	var question_type_id;
	var topic_id;
	function search_criteria(){
		question_type_id = #('#type').val();
		alert(question_type_id);

		;
	}

</script>

