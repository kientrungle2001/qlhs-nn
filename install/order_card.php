<?php
// Set up table  order_card
echo 'Install order_card Table <br />';
$version = _dbs()->getVersion('order_card');
// create table
if ($version < 1) {
	_dbs()->create('order_card')

		->addInt('cardId', 11)
		->addInt('quantity',11)
		->addDatetime('date')
		->addVarchar('fullname')
		->addVarchar('address')
		->addVarchar('phone')
		->addDouble('amount', 11)
		->addVarchar('status')
		->execute();
	_dbs()->commitVersion('order_card', 1);
	$version = 1;
}