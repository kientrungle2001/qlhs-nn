<?php
// Set up table questions
echo 'Install video Table <br />';
$version = _dbs()->getVersion('level_status');
// create table
if ($version < 1) {
    _dbs()->create('level_status')
        ->addInt('type_id')
        ->addVarchar('start_status', 255)
        ->addVarchar('end_status', 255)
        ->addDatetime('created')
        ->addDatetime('modified')
        ->addInt('modifiedId')
        ->addInt('createdId')
        ->addInt('status', 4)
        ->execute();
    _dbs()->commitVersion('level_status', 1);
    $version = 1;
}