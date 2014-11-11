<?php
$request = pzk_element('request');
$item = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', '%,'.$request->getSegment(3). ',%'))->orderBy('ordering asc, id desc')->limit(1,0)->result_one();
?>
<h2><a href="/{item[alias]}">{item[title]}</a></h2>
{item[brief]}