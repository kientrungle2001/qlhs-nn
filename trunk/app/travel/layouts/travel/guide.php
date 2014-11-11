<?php $guides = pzk_data('guides');?>
<div class="row tour-guide my-box">		
	<h2><a href="#">Những điều cần biết khi đi du lịch</a></h2>
	{each $guides as $guide}
	<div class="col-sm-3"><a href="{url /guide}/detail/{guide[id]}">{guide[title]}</a></div>
	{/each}
</div>