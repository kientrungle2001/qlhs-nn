<?php
// Set up table  history_payment
echo 'Install history_payment Table <br />';
$version = _dbs()->getVersion('history_payment');
// create table
if ($version < 1) {
	_dbs()->create('history_payment')

		->addVarchar('username')
		->addInt('amount', 11)
		->addVarchar('typepayment')
		->addDatetime('datepayment')
		->addVarchar('transactionid')
		->addVarchar('optionpayment')
		->addVarchar('transactionstatus')
		->addInt('userAdd',11)
		->addDatetime('dateAdd')
		->addInt('userModified')
		->addDatetime('dateModified')
		->execute();
	_dbs()->commitVersion('history_payment', 1);
	$version = 1;
}