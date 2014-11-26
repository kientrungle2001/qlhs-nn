<div style="width: <?php echo @$data->width;?>; height: <?php echo @$data->height;?>; ">
	<div class="thumb_images" style="width: <?php echo @$data->width;?>; height: <?php echo @$data->height;?>; ">
		<?php $data->displayChildren('[class=thumb]');?>
	</div>
	<div class="original_images" style="width: <?php echo @$data->width;?>; height: <?php echo @$data->height;?>; ">
		<?php $data->displayChildren('[class=image]');?>
	</div>
</div>
<?php $data->displayChildren('all');?>