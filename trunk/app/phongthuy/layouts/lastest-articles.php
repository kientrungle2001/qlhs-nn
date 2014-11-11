<?php
$request = pzk_element('request');
if($request->routeTable == 'news_article') {
	$cateLikeConds = '%' . @$request->routeData['categories'] . '%';
} else {
	$cateLikeConds = '%,' .$request->getSegment(3) . ',%';
}
$items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', $cateLikeConds))->orderBy('ordering asc, id desc')->limit(20,0)->result();
$items2 = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', $cateLikeConds))->orderBy('ordering desc, id asc')->limit(20,0)->result();
?>
<div class="tabpane" style="background: #ddd;">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#lastest-articles" role="tab" data-toggle="tab">Mới >>> Cũ</a></li>
  <li><a href="#oldest-articles" role="tab" data-toggle="tab">Cũ >>> Mới</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="lastest-articles">
	<ul>
	{? $first = false; ?}
	{each $items as $item}
		{? if($first) { $first = false; continue; } ?}
		<li><a href="/{item[alias]}">{item[title]}</a></li>
	{/each}
	</ul>
  </div>
  <div class="tab-pane" id="oldest-articles">
	<ul>
	{each $items2 as $item}
		<li><a href="/{item[alias]}">{item[title]}</a></li>
	{/each}
	</ul>
  </div>
</div>
</div>