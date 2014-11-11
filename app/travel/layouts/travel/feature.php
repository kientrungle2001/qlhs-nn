<?php $tours = $data->getTours(); 
$durations = pzk_data('durations');
$transports = pzk_data('transports');
?>
<div class="feature-tour-list my-box">
	<h2><a href="#">Các tour nổi bật</a></h2>
	<div class="row">
	{each $tours as $tour}
	<div class="col-sm-6">
		<div class="tour-box">
			<strong><a href="{url /tour}/detail/{tour[id]}">{tour[title]}</a></strong>
			<div class="row">
				<div class="col-sm-12">
					<div class="tour-image">
						<img src="{turl images/t1.jpg}" style="width: 100%" />
					</div>
					<div class="tour-description">
						Giá: {tour[price]}<br />
						Thời gian: <?php $duration = $durations[$tour['durationId']];?>{duration[title]}<br />
						Phương tiện: 
						<?php $tourtransports = array();
						$transportIds = explode(',', $tour['transports']);
						foreach($transportIds as $id) {
							$tourtransports[] = $transports[$id]['title'];
						}
						?>
						<?php echo implode(', ', $tourtransports);?>
						<br />
						Khách sạn: {tour[hotels]}
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	{/each}
	</div>
</div>