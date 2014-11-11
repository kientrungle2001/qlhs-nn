<?php
$items = _db()->select('*')->from('news_article')->orderBy('id asc')->result();
?>
<ul>
{each $items as $item}
	<li><h3><a href="/{item[alias]}">{item[title]}</a></h3></li>
{/each}
</ul>