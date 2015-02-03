<?php
// Set up table questions
echo 'Install admin level action Table <br />';
$version = _dbs()->getVersion('admin_level_action');
// create table
if ($version < 1) {
    _dbs()->create('admin_level_action')
        ->addVarchar('admin_action', 255)
        ->addVarchar('admin_level', 255)
        ->addVarchar('params', 255)
        ->addVarchar('action_type', 255)
        ->addInt('admin_level_id')
        ->addInt('status', 4)
        ->execute();
    _dbs()->commitVersion('admin_level_action', 1);
    $version = 1;
}