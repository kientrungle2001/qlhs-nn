﻿<?php
// c�i d?t c�c b?ng csdl b?ng c�c phi�n b?n
echo 'Install comment Table<br />';
$version = _dbs()->getVersion('comment');
// create table
if ($version < 1) {
	_dbs()->create('comment')
		->addInt('newsId')
		->addText('comment')
		->addInt('likecomment')
		->addText('ip')
		->addDatetime('created')
		->addInt('userId')
		->execute();
	_dbs()->commitVersion('comment', 1);
	$version = 1;
}