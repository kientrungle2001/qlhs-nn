<?php
// Set up table  lesson_favorite
echo 'Install lesson_favorite Table <br />';
$version = _dbs()->getVersion('lesson_favorite');
// create table
if ($version < 1) {
	_dbs()->create('lesson_favorite')
		->addInt('userId', 11)
		->addInt('lessonId',11)
		->addInt('categoriesId')
		->addDatetime('date')
		->execute();
	_dbs()->commitVersion('lesson_favorite', 1);
	$version = 1;
}