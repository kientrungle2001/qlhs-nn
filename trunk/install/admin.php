<?php
// Set up table questions
echo 'Install admin Table <br />';
$version = _dbs()->getVersion('admin');
// create table
if ($version < 1) {
    _dbs()->create('admin')
        ->addVarchar('name', 200)
        ->addInt('usertype_id')
        ->addVarchar('password', 200)
        ->addInt('status', 4)
        ->execute();
    _dbs()->commitVersion('admin', 1);
    $version = 1;
}