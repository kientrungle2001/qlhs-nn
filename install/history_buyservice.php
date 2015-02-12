<?php
// Set up table  history_buyservice
echo 'Install history_buyservice Table <br />';
$version = _dbs()->getVersion('history_buyservice');
// create table
if ($version < 1) {
	_dbs()->create('history_buyservice')

		
		->addInt('userId', 11)
		->addInt('serviceId', 11)
		->addDouble('amount',11)
		->addDatetime('date')
		->addInt('userAdd',11)
		->addDatetime('dateAdd')
		->addInt('userModified',11)
		->addDatetime('dateModified')
		->execute();
	_dbs()->commitVersion('history_buyservice', 1);
	$version = 1;
}