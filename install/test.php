<?php
// cài đặt các bảng csdl bằng các phiên bản
echo 'Install Test2 <br />';
$version = _dbs()->getVersion('test2');
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

if($version < 2) {
	_dbs()->select('test2')->changeVarchar('status')->execute();
	_dbs()->commitVersion('test2', 2);
	$version = 2;
}
if($version < 3) {
	_dbs()->select('test2')->changeInt('status')->execute();
	_dbs()->commitVersion('test2', 3);
	$version = 3;
}