<?php
// cài d?t các b?ng csdl b?ng các phiên b?n
echo 'Install banner_click Table<br />';
$version = _dbs()->getVersion('banner_click');
// create table
if ($version < 1) {
	_dbs()->create('banner_click')
		->addText('ip')
		->addText('utm_source')
		->addDatetime('timeclick')
		->addInt('bannerId')
		->execute();
	_dbs()->commitVersion('banner', 1);
	$version = 1;
}