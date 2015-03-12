<?php
// Set up table  user_answers
echo 'Install user_answers Table <br />';
$version = _dbs()->getVersion('user_answers');
// create table
if ($version < 1) {
	_dbs()->create('user_answers')
		->addInt('user_book_id')
		->addInt('questionId')
		->addVarchar('question_type', 255)
		->addVarchar('content', 255)
		->execute();
	_dbs()->commitVersion('user_answers', 1);
	$version = 1;
}