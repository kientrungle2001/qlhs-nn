<?php $guides = pzk_data('guides');?>
<div class="row tour-guide my-box">		
	<h2><a href="#">Những điều cần biết khi đi du lịch</a></h2>
	<?php foreach ( $guides as $guide ) : ?>
	<div class="col-sm-3"><a href="<?php echo BASE_REQUEST . '/guide'; ?>/detail/<?php echo @$guide['id'];?>"><?php echo @$guide['title'];?></a></div>
	<?php endforeach; ?>
</div>