<?php
// cài d?t các b?ng csdl b?ng các phiên b?n
echo 'Install banner Table<br />';
$version = _dbs()->getVersion('banner');
// create table
if ($version < 1) {
	_dbs()->create('banner')
		->addDatetime('ngaytao')
		->addVarchar('url', 255)
		->addVarchar('title', 255)
		->addInt('click')
		->execute();
	_dbs()->commitVersion('banner', 1);
	$version = 1;
}