<?php
// Set up table  wallets
echo 'Install wallets Table <br />';
$version = _dbs()->getVersion('wallets');
// create table
if ($version < 1) {
	_dbs()->create('wallets')
		->addVarchar('username')
		->addDouble('amount')
		->execute();
	_dbs()->commitVersion('wallets', 1);
	$version = 1;
}