<?php 
$index = 1;
$items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', ',37,'))->orderBy('createdTime desc, id desc')->limit(5, 0)->result();?>
<ul>{each $items as $item}
	<li><a href="{item[alias]}">{item[title]} {? if($index < 4) { echo ' - (<span style="color: red">Mới</span>)'; } ?}</a></li>
{? $index++; ?}
{/each}</ul>
