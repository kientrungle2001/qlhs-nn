<?php
// Set up table  friend
echo 'Install friend Table <br />';
$version = _dbs()->getVersion('friend');
// create table
if ($version < 1) {
	_dbs()->create('friend')

		->addVarchar('username')
		
		->addVarchar('userfriend')
		
		->addDatetime('date')
		
		->execute();
	_dbs()->commitVersion('friend', 1);
	$version = 1;
}