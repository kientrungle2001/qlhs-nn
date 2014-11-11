<?php 
	$types = pzk_data('types');
?>
<div class="tour-type my-box">
	<h2><a href="#">Loại hình tour</a></h2>
	{each $types as $type}
	<div class="col-sm-3"><a href="{url /type}/list/{type[id]}">{type[title]}</a></div>
	{/each}
	<div class="clear"></div>
</div>