<?php
// cài đặt các bảng csdl bằng các phiên bản
echo 'Install Test2 Table<br />';
$version = _dbs()->getVersion('test2');
// create table
if ($version < 1) {
	_dbs()->create('test2')
		->addVarchar('name', 255)
		->addText('description')
		->addDouble('amount')
		->addInt('status')
		->execute();
	_dbs()->commitVersion('test2', 1);
	$version = 1;
}

// change field type
if($version < 2) {
	_dbs()->select('test2')->changeVarchar('status')->execute();
	_dbs()->commitVersion('test2', 2);
	$version = 2;
}

// change field type
if($version < 3) {
	_dbs()->select('test2')->changeInt('status')->execute();
	_dbs()->commitVersion('test2', 3);
	$version = 3;
}

// drop field
if($version < 4) {
	_dbs()->select('test2')->drop('status')->execute();
	_dbs()->commitVersion('test2', 4);
	$version = 4;
}

// add field
if($version < 5) {
	_dbs()->select('test2')->addInt('status')->execute();
	_dbs()->commitVersion('test2', 5);
	$version = 5;
}
