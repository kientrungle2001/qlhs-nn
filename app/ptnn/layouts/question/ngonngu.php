<?php  $category = $data->getCategory();?>


<div class="well">
	<?php if(isset($category['child']) && !empty($category['child'])):?>
	<div class="row">
		
		<div class="form-group col-xs-12">
		
			<label for="type">Chọn dạng câu hỏi</label>
			
			<select id="type" class="form-control input-sm" onchange="" name="type">
				<option class="padding-left-10" value="<?=$category['child']['']?>"> Chọn từ đúng</option>
			</select>
		</div>
	</div>
	<?php endif;?>
	<div class="row">
		
	
	</div>

</div>

