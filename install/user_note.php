<?php
// Set up table  user_note
echo 'Install user_note Table <br />';
$version = _dbs()->getVersion('user_note');
// create table
if ($version < 1) {
	_dbs()->create('user_note')

		->addVarchar('username')
		->addVarchar('contentnote')
		->addDatetime('datenote')
		->addVarchar('titlenote')
		->addInt('view', 11)
		->addVarchar('comment')
		->execute();
	_dbs()->commitVersion('user_note', 1);
	$version = 1;
}