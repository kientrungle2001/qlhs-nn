<?php 
$categories = _db()->select('*')->from('categories')->result(); 
$categories = buildArr($categories,'parent',0);
$questionTypes = _db()->select('*')->from('questiontype')->result();
?>
<form id="questionsAddForm" role="form" method="post" action="{url /admin_questions/addPost}">
  	<input type="hidden" name="id" value="" />
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="name">Câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="name" class="form-control tinymce" rows="5" name="name"></textarea>
	    </div>
 	</div>
 	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="type">Loại câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
		    <select class="form-control" id="type" name="type">
		        <option value="">-- Loại câu hỏi --</option>
				<?php $question_types = $data->getQuestionType();?>
				<?php if(isset($question_types)):?>
					<?php foreach($question_types as $key	=>$value):?>
						
						<option value="<?=$value['question_type']?>" class="padding-left-10"> <?=$value['name']?></option>
							
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
  	</div>
    <div class="form-group col-xs-12">
        <div class="col-xs-2">
        	<label for="level">Mức độ câu hỏi</label>
        </div>
        <div class="col-xs-10">
	        <select class="form-control" id="level" name="level" placeholder="Loại" value="{item[level]}">
	            <option value="">-- Chọn mức độ câu hỏi --</option>
	            <option value="1">Dễ</option>
	            <option value="2">Bình thường</option>
	            <option value="3">Khó</option>
	        </select>
        </div>
        <script>
            $('#type').val('{item[type]}');
        </script>
    </div>
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="categoryIds">Danh mục</label>
	    </div>
	    <div class="col-xs-10">
		    <select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="{item[categoryIds]}" style="height: 300px">
			{each $categories as $cat}
			<?php 
			$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';	
			$tabs = str_repeat($tab, $cat['level']);
			$catName = $tabs.$cat['name'];
			?>
			<option value="{cat[id]}">{catName}</option>
			{/each}
			</select>
		</div>
  	</div>
  	<div class="col-xs-12">
  		<div class="col-xs-4 col-xs-offset-2">
		  	<button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-save"></span> Cập nhật</button>
		  	<a class="btn btn-default" href="{url /admin_questions/index}">Quay lại</a>
		</div>
  	</div>
</form>
<?php 
$addValidator = json_encode(pzk_app()->controller->addValidator);
?>
<script>
	$('#questionsAddForm').validate({addValidator});
	setTinymce();
</script>