<?php
$categories = $data->getCategories();
?>
<div class="tour-category-list my-box">
	<h2><a href="#">{prop title}</a></h2>
	<ul>
	{each $categories as $cat}
	  <li ><a href="{url /tour}/{data.action}/{cat[id]}">{cat[title]}</a></li>
	{/each}
	</ul>
</div>