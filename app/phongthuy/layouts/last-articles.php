<?php
$request = pzk_element('request');
$items = _db()->useCB()->select('*')
		->from('news_article')
		->where(array('like', 'categories', '%,'.$request->getSegment(3).',%'))
		->orderBy('ordering asc, id desc')->limit(20,0)->result();
$first = true;
?>
{each $items as $item}
{? if($first) { $first = false; continue; } ?}
<h2><a href="/{item[alias]}">{item[title]}</a></h2>
{item[brief]}
{/each}