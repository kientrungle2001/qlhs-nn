<?php 
	$item = $data->getItem(); 
	$question_types = $data->getQuestionType();
	
	$categories = _db()->select('*')->from('categories')->result(); 
	$categories = buildArr($categories,'parent',0);
	$categoryIds = explode(',', $item['categoryIds']);
?>
<form id="questionsEditForm" role="form" method="post" action="{url /admin_questions/editAllCatePost}">
  	<input type="hidden" name="id" value="{item[id]}" />
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="name">Câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="name" class="form-control tinymce" rows="2" name="name" aria-required="true" aria-invalid="false"><?=$item["name"];?></textarea>
	    </div>
  	</div>
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="request" style="background-color:#EEEEEE" class="form-control" rows="2" name="request"><?=$item["request"];?></textarea>
	    </div>
  	</div>
  	
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="type">Loại câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
		    <select id="type" name="type" class="form-control input-sm">
				<?php if(isset($question_types)):?>
					<?php foreach($question_types as $key	=>$value):?>
						<option value="<?=$value['question_type']?>"  class="padding-left-10"> <?=$value['name']?></option>
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
		<script type="text/javascript">
			$('#type'). val('{item[type]}');
		</script>
 	</div>
  	
    <div class="form-group col-xs-12">
    	<div class="col-xs-2">
        	<label for="level">Độ khó</label>
        </div>
        <div class="col-xs-10">
	        <select class="form-control input-sm" id="level" name="level" >
	            <option value="">-- Chọn mức độ câu hỏi --</option>
	            <option <?php if($item['level'] ==1) { echo 'selected="selected"'; } ?> value="1">Dễ</option>
	            <option <?php if($item['level'] ==2) { echo 'selected="selected"'; } ?> value="2">Bình thường</option>
	            <option <?php if($item['level'] ==3) { echo 'selected="selected"'; } ?> value="3">Khó</option>
	        </select>
        </div>
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
			$tabs = str_repeat($tab, $cat['lever']);
			$catName = $tabs.$cat['name'];
			$selected = '';
			if(in_array($cat['id'], $categoryIds)) {
				$selected = 'selected="selected"';
			}
			?>
			<option {selected} value="{cat[id]}">{catName}</option>
			{/each}
			</select>
		</div>
  	</div>
  	<div class="col-xs-12">
  		<div class="col-xs-4 col-xs-offset-2">
		  	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
		  	<a class="btn btn-default" href="{url /admin_questions/index}">Quay lại</a>
	  	</div>
  	</div>
</form>
<?php 
$editValidator = json_encode(pzk_app()->controller->editValidator);
?>
<script>
$('#questionsEditForm').validate({editValidator});
setTinymce();
</script>