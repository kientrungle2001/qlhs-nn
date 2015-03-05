<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install aqs_answer Table<br />';
$version = _dbs()->getVersion('aqs_answer');
// create table
if ($version < 1) {
	_dbs()->create('aqs_answer')
		->addInt('questionId')
		->addText('answer')
		->addInt('userId')
		->execute();
	_dbs()->commitVersion('aqs_answer', 1);
	$version = 1;
}