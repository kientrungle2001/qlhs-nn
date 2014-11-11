<?php
$tours = $data->getTours();
?>
<div class="favorite-tour-list my-box">
	<h2><a href="#">{data.title}</a></h2>
	{each $tours as $tour}
	<div class="tour-item">
		<div class="tour-image">
			<img src="{turl images/t1.jpg}" style="width: 100%" />
		</div>
		<div class="tour-description">
			<a href="{url /tour}/detail/{tour[id]}">{tour[title]}</a>
		</div>
		<div class="clear"></div>
	</div>
	{/each}
</div>