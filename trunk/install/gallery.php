<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install gallery Table<br />';
$version = _dbs()->getVersion('gallery');
// create table
if ($version < 1) {
	_dbs()->create('gallery')
		->addText('title')
		->addText('brief')
		->addDate('date')
		->execute();
	_dbs()->commitVersion('gallery', 1);
	$version = 1;
}