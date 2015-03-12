<?php
// Set up table  user_book
echo 'Install user_book Table <br />';
$version = _dbs()->getVersion('user_book');
// create table
if ($version < 1) {
	_dbs()->create('user_book')
		->addInt('userId')
		->addInt('categoryId')
		->addInt('time')
		->addTinyint('quantity_question')
		->addTinyint('mark_status')
		->addDatetime('date')
		->execute();
	_dbs()->commitVersion('user_book', 1);
	$version = 1;
}