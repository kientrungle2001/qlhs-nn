<?php
// cài đặt các bảng csdl bằng các phiên bản
echo 'Install Test2 <br />';
_dbs()->create('test2')
	->addVarchar('name', 255)
	->addText('description')
	->addDouble('amount')
	->addInt('status')
	->execute();
_dbs()->select('test2')->changeInt('status')->execute();