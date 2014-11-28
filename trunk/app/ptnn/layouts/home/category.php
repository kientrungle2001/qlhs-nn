<?php 
	$category = $data->listCate();
	$cateParent = buildArr($category,'parent',0);
 ?>
<label for="">Categories</label>
<select name="" id="">
	<option value="">Select categories ... </option>
	{each $cateParent as $value}
	<?php 
		$tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
		if($value['lever'] == 1){
			$cate = $tab.$value['name'];
		} else {
			for ($i= 2; $i <= $value['lever'] ; $i++) { 
				$tab = $tab.$tab;
			}
			$cate = $tab.$value['name'];
		}
	 ?>
	<option value="{value[id]}"><?php echo $cate; ?></option>
	{/each}
</select>
