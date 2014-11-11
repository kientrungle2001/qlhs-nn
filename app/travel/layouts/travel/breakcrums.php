<?php
$cats = $data->getCategories();
$cats = array_reverse($cats);
?>
<div class="col-sm-12">
<div class="my-box">
<a href="{url /}">Trang chủ</a>
{each $cats as $cat}
&gt; <a href="{url /tour}/{data.action}/{cat[id]}">{cat[title]}</a> 
{/each}
</div>
</div>