<?php
$index = 1; 
$items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', ',4,'))->orderBy('createdTime desc, id desc')->limit(5, 0)->result();?>
<ul><?php foreach ( $items as $item ) : ?>
	<li><a href="/<?php echo @$item['alias'];?>"><?php echo @$item['title'];?><?php if($index < 4) { echo ' - (<span style="color: red">Mới</span>)'; } ?></a></li>
<?php $index++; ?>
<?php endforeach; ?></ul>
