<?php
// Set up table answers_question_tn
echo 'Install answers_question_tn Table <br />';
$version = _dbs()->getVersion('answers_question_tn');
// create table
if ($version < 1) {
	_dbs()->create('answers_question_tn')
		->addInt('question_id')
		->addVarchar('content')
		->addInt('status', 4)
		->addVarchar('content_full')
		->addText('recommend')
		->addDatetime('date_modify')
		->addInt('admin_modify')
		->execute();
	_dbs()->commitVersion('answers_question_tn', 1);
	$version = 1;
}