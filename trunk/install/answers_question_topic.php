<?php
// Set up table answers_question_topic
echo 'Install answers_question_topic Table <br />';
$version = _dbs()->getVersion('answers_question_topic');
// create table
if ($version < 1) {
	_dbs()->create('answers_question_topic')
		->addInt('question_id')
		->addInt('answers_question_tn_id')
		->addVarchar('content', 500)
		->execute();
	_dbs()->commitVersion('answers_question_topic', 1);
	$version = 1;
}