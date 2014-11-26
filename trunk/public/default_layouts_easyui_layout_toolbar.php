<div id="<?php echo @$data->id;?>" style="padding:5px;height:auto;">
	<div style="margin-bottom:5px; <?php echo @$data->style;?>">
		<?php $data->displayChildren('all');?>
	</div>
</div>