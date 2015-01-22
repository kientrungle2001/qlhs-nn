<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install news_visitor Table<br />';
$version = _dbs()->getVersion('news_visitor');
// create table
if ($version < 1) {
	_dbs()->create('news_visitor')
		->addInt('newsId')
		->addVarchar('ip', 255)		
		->addDatetime('visited')
		->execute();
	_dbs()->commitVersion('news_visitor', 1);
	$version = 1;
}