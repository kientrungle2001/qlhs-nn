<?php
// cài đặt các bảng csdl bằng các phiên bản
echo 'Install Url_Rewrite Table<br />';
$version = _dbs()->getVersion('url_rewrite');
// create table
if ($version < 1) {
	_dbs()->create('url_rewrite')
		->addVarchar('alias', 255)
		->addVarchar('path', 255)
		->addInt('status')
		->execute();
	_dbs()->commitVersion('url_rewrite', 1);
	$version = 1;
}