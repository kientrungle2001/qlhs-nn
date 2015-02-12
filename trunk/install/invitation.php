<?php
// Set up table  invitation
echo 'Install invitation Table <br />';
$version = _dbs()->getVersion('invitation');
// create table
if ($version < 1) {
	_dbs()->create('invitation')
		->addVarchar('username')
		->addVarchar('userinvitation')
		->addVarchar('invitation')
		->execute();
	_dbs()->commitVersion('invitation', 1);
	$version = 1;
}