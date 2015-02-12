<?php
// Set up table  user_note_comment
echo 'Install user_note_comment Table <br />';
$version = _dbs()->getVersion('user_note_comment');
// create table
if ($version < 1) {
	_dbs()->create('user_note_comment')
		->addInt('userId', 11)
		->addInt('noteId', 11)
		->addVarchar('comment')
		->addDatetime('date')
		->execute();
	_dbs()->commitVersion('user_note_comment', 1);
	$version = 1;
}