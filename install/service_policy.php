<?php
// Set up table  service_policy
echo 'Install service_policy Table <br />';
$version = _dbs()->getVersion('service_policy');
// create table
if ($version < 1) {
	_dbs()->create('service_policy')
		->addInt('serviceId', 11)
		->addDouble('discount', 11)
		->addVarchar('note')
		->addDatetime('startDate')
		->addDatetime('endDate')
		->addInt('userAdd',11)
		->addDatetime('dateAdd')
		->addInt('userModified',11)
		->addDatetime('dateModified')
		->execute();
	_dbs()->commitVersion('service_policy', 1);
	$version = 1;
}