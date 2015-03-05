<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install aqs_question Table<br />';
$version = _dbs()->getVersion('aqs_question');
// create table
if ($version < 1) {
	_dbs()->create('aqs_question')
		->addText('question')
		->addInt('answer')
		->addInt('userId')
		->execute();
	_dbs()->commitVersion('aqs_question', 1);
	$version = 1;
}