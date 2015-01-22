<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install news Table<br />';
$version = _dbs()->getVersion('news');
// create table
if ($version < 1) {
	_dbs()->create('news')
		->addVarchar('title', 255)
		->addInt('parent')
		->addText('brief')
		->addText('content')
		->addInt('views')
		->addInt('comments')
		->addText('img')
		->addText('alias')
		->execute();
	_dbs()->commitVersion('news', 1);
	$version = 1;
}