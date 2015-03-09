<?php
// Set up table topics
echo 'Install topics Table <br />';
$version = _dbs()->getVersion('topics');
// create table
if ($version < 1) {
	_dbs()->create('topics')
		->addVarchar('name', 225)
		->addDatetime('created')
		->addDatetime('modified')
		->addInt('createdId')
		->addInt('modifiedId')
		->execute();
	_dbs()->commitVersion('topics', 1);
	$version = 1;
}