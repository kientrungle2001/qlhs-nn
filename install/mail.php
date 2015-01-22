<?php
// c?d?t c?b?ng csdl b?ng c?phi?b?n
echo 'Install mail Table<br />';
$version = _dbs()->getVersion('mail');
// create table
if ($version < 1) {
	_dbs()->create('mail')
		->addVarchar('mail', 255)
		->addDatetime('dateregister')
		->execute();
	_dbs()->commitVersion('mail', 1);
	$version = 1;
}