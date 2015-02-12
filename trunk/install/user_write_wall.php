<?php
// Set up table  user_write_wall
echo 'Install user_write_wall Table <br />';
$version = _dbs()->getVersion('user_write_wall');
// create table
if ($version < 1) {
	_dbs()->create('user_write_wall')
		->addVarchar('username')
		->addVarchar('userwritewall')
		->addVarchar('content')
		->addDatetime('datewrite')
		->execute();
	_dbs()->commitVersion('user_write_wall', 1);
	$version = 1;
}