<?php
// Set up table  card_nextnobels
echo 'Install card_nextnobels Table <br />';
$version = _dbs()->getVersion('card_nextnobels');
// create table
if ($version < 1) {
	_dbs()->create('card_nextnobels')

		->addVarchar('pincard')
		->addInt('price', 11)
		->addInt('discount', 11)
		->addVarchar('serial')
		->addInt('userAdd',11)
		->addDatetime('dateAdd')
		->addInt('userModified')
		->addDatetime('dateModified')
		->addInt('userActive')
		->addDatetime('dateActive')
		->addInt('status',4)
		->execute();
	_dbs()->commitVersion('card_nextnobels', 1);
	$version = 1;
}