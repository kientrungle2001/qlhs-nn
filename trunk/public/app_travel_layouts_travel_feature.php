<?php $tours = $data->getTours(); 
$durations = pzk_data('durations');
$transports = pzk_data('transports');
?>
<div class="feature-tour-list my-box">
	<h2><a href="#">Các tour nổi bật</a></h2>
	<div class="row">
	<?php foreach ( $tours as $tour ) : ?>
	<div class="col-sm-6">
		<div class="tour-box">
			<strong><a href="<?php echo BASE_REQUEST . '/tour'; ?>/detail/<?php echo @$tour['id'];?>"><?php echo @$tour['title'];?></a></strong>
			<div class="row">
				<div class="col-sm-12">
					<div class="tour-image">
						<img src="<?php echo pzk_element("page")->getTemplatePath("images/t1.jpg"); ?>" style="width: 100%" />
					</div>
					<div class="tour-description">
						Giá: <?php echo @$tour['price'];?><br />
						Thời gian: <?php $duration = $durations[$tour['durationId']];?><?php echo @$duration['title'];?><br />
						Phương tiện: 
						<?php $tourtransports = array();
						$transportIds = explode(',', $tour['transports']);
						foreach($transportIds as $id) {
							$tourtransports[] = $transports[$id]['title'];
						}
						?>
						<?php echo implode(', ', $tourtransports);?>
						<br />
						Khách sạn: <?php echo @$tour['hotels'];?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
</div>