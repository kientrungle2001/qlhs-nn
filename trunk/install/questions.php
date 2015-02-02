<?php
// Set up table questions
echo 'Install questions Table <br />';
$version = _dbs()->getVersion('questions');
// create table
if ($version < 1) {
	_dbs()->create('questions')
		->addVarchar('request', 500)
		->addText('name')
		->addVarchar('categoryIds', 500)
		->addInt('level', 4)
		->addVarchar('type', 255)
		->addDatetime('date_create')
		->addInt('admin_create')
		->addDatetime('date_modify')
		->addInt('admin_modify')
		->execute();
	_dbs()->commitVersion('questions', 1);
	$version = 1;
}