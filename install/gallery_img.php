<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install gallery_img Table<br />';
$version = _dbs()->getVersion('gallery_img');
// create table
if ($version < 1) {
	_dbs()->create('gallery_img')
		->addText('galleryId')
		->addInt('url')
		->execute();
	_dbs()->commitVersion('gallery_img', 1);
	$version = 1;
}