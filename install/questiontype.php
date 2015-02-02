<?php
// Set up table questiontype
echo 'Install questiontype Table <br />';
$version = _dbs()->getVersion('questiontype');
// create table
if ($version < 1) {
	_dbs()->create('questiontype')
		->addVarchar('name', 500)
		->addVarchar('request', 500)
		->addVarchar('question_type', 500)
		->addVarchar('group_question', 4)
		->addDatetime('date_create')
		->addDatetime('date_modify')
		->addInt('admin_create')
		->addInt('admin_modify')
		->execute();
	_dbs()->commitVersion('questiontype', 1);
	$version = 1;
}