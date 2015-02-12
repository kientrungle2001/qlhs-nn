<?php
// Set up table  service_packages
echo 'Install service_packages Table <br />';
$version = _dbs()->getVersion('service_packages');
// create table
if ($version < 1) {
	_dbs()->create('service_packages')

		->addVarchar('serviceName')
		->addDouble('amount', 11)
		->addInt('userAdd',11)
		->addDatetime('dateAdd')
		->addInt('userModified',11)
		->addDatetime('dateModified')
		->execute();
	_dbs()->commitVersion('service_packages', 1);
	$version = 1;
}