<?php
// cài d?t các b?ng csdl b?ng các phiên b?n
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