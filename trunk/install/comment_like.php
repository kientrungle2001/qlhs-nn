<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install comment_like Table<br />';
$version = _dbs()->getVersion('comment_like');
// create table
if ($version < 1) {
	_dbs()->create('comment_like')
		->addInt('newsId')
		->addInt('commentId')
		->addInt('userId')
		->addDatetime('timelike')
		->execute();
	_dbs()->commitVersion('comment_like', 1);
	$version = 1;
}