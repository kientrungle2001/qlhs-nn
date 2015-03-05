<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install featured_visitor Table<br />';
$version = _dbs()->getVersion('featured_visitor');
// create table
if ($version < 1) {
	_dbs()->create('featured_visitor')
		->addInt('featuredId')
		->addText('ip')
		->addDate('visited')
		->execute();
	_dbs()->commitVersion('featured_visitor', 1);
	$version = 1;
}