<?php
// Set up table questions
echo 'Install lessons Table <br />';
$version = _dbs()->getVersion('lessons');
// create table
if ($version < 1) {
    _dbs()->create('lessons')
        ->addInt('user_id')
        ->addText('question_ids')
        ->addInt('category_id')
        ->addInt('subject')
        ->addInt('number')
        ->addInt('time')
        ->addInt('level')
        ->addInt('start_time')
        ->addInt('end_time')
        ->addText('answer_value')
        ->addFloat('total')
        ->addFloat('total_true')
        ->execute();
    _dbs()->commitVersion('lessons', 1);
    $version = 1;
}