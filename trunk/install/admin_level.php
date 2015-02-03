<?php
// Set up table questions
echo 'Install admin level Table <br />';
$version = _dbs()->getVersion('admin_level');
// create table
if ($version < 1) {
    _dbs()->create('admin_level')
        ->addVarchar('admin_level', 200)
        ->addInt('status', 4)
        ->execute();
    _dbs()->commitVersion('admin_level', 1);
    $version = 1;
}