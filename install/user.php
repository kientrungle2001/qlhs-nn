<?php
// Set up table  user
echo 'Install user Table <br />';
$version = _dbs()->getVersion('user');
// create table
if ($version < 1) {
	_dbs()->create('user')
		->addVarchar('username')
		->addVarchar('name')
		->addVarchar('password')
		->addVarchar('email')
		->addDatetime('birthday')
		->addVarchar('address')
		->addVarchar('phone')
		->addInt('idpassport', 11)
		->addDatetime('iddate')
		->addVarchar('idplace')
		->addVarchar('key')
		->addInt('status',1)
		->addVarchar('sign')
		->addTinyint('sex')
		->addVarchar('type')
		->addDatetime('registered')
		->addDatetime('lastlogined')
		->addInt('creatorID',11)
		->addDatetime('modified')
		->addInt('modifiedId')
		->addInt('levelId',11)
		->addInt('usertypeId',11)
		->addVarchar('avatar')
		->execute();
	_dbs()->commitVersion('user', 1);
	$version = 1;
}