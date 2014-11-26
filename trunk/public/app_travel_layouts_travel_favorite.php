<?php
$tours = $data->getTours();
?>
<div class="favorite-tour-list my-box">
	<h2><a href="#"><?php echo @$data->title;?></a></h2>
	<?php foreach ( $tours as $tour ) : ?>
	<div class="tour-item">
		<div class="tour-image">
			<img src="<?php echo pzk_element("page")->getTemplatePath("images/t1.jpg"); ?>" style="width: 100%" />
		</div>
		<div class="tour-description">
			<a href="<?php echo BASE_REQUEST . '/tour'; ?>/detail/<?php echo @$tour['id'];?>"><?php echo @$tour['title'];?></a>
		</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; ?>
</div>