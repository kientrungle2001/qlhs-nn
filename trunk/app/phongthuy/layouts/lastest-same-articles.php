<?php
$request = pzk_element('request');
$items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', ',37,'))->orderBy('id desc')->limit(5,0)->result();
$items2 = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', ',37,'))->orderBy('id asc')->limit(5,0)->result();
?>
<div class="tabpane" style="background: #ddd;">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#lastest-articles" role="tab" data-toggle="tab">Bài Mới Đến Cũ</a></li>
  <li><a href="#oldest-articles" role="tab" data-toggle="tab">Bài Cũ Về Mới</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="lastest-articles">
	<ul>
	{each $items as $item}
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