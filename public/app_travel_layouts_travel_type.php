<?php 
	$types = pzk_data('types');
?>
<div class="tour-type my-box">
	<h2><a href="#">Loại hình tour</a></h2>
	<?php foreach ( $types as $type ) : ?>
	<div class="col-sm-3"><a href="<?php echo BASE_REQUEST . '/type'; ?>/list/<?php echo @$type['id'];?>"><?php echo @$type['title'];?></a></div>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>