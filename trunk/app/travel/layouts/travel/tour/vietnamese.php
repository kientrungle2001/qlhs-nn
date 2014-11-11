<?php $cat = $data->getCategory();
$subCats = $data->getCategories($cat['id']); 
$durations = pzk_data('durations');
$transports = pzk_data('transports');
$pageNum = $data->pageNum;
if(count($subCats)) {
?>
<div class="col-sm-12">
{each $subCats as $subCat}
	<div class="feature-tour-list my-box">
		<h2><a href="{url /tour}/vietnamese/{subCat[id]}">{subCat[title]}</a></h2>
		<div class="row">
		<?php $tours = $data->getTours($subCat['id'], 4, 0);?>
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
{/each}
</div>
<?php } else { 

?>

<div class="col-sm-12">
	<div class="feature-tour-list my-box">
		
		<div class="row">
		<?php $tours = $data->getTours($cat['id'], 4, $pageNum);?>
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
</div>
<div class="col-sm-12">
<div style="text-align: right;">
<ul class="pagination">
<?php 
$count = $data->countTours($cat['id'], 10);
for($i = 0; $i < $count; $i++) { 
if($i == $pageNum) $active = ' class="active"'; else $active='';
?>
	<li{active}><a href="{url /tour}/vietnamese/{cat[id]}/{i}">{? echo $i+1 ?}</a></li>
<?php
} ?>
</ul>
</div>
</div>
<?php 
} ?>