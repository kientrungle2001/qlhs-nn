<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install featured Table<br />';
$version = _dbs()->getVersion('featured');
// create table
if ($version < 1) {
	_dbs()->create('featured')
		->addText('title')
		->addInt('parent')
		->addText('brief')
		->addText('content')
		->addInt('views')
		->addInt('comments')
		->addText('img')
		->addText('alias')
		->execute();
	_dbs()->commitVersion('featured', 1);
	$version = 1;
}