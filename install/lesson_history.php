<?php
// Set up table  lesson_history
echo 'Install lesson_history Table <br />';
$version = _dbs()->getVersion('lesson_history');
// create table
if ($version < 1) {
	_dbs()->create('lesson_history')
		->addInt('userId', 11)
		->addInt('lessonId',11)
		->addInt('categoriesId')
		->addDatetime('date')
		->execute();
	_dbs()->commitVersion('lesson_history', 1);
	$version = 1;
}