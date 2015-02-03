<?php
// Set up table questions
echo 'Install admin menu Table <br />';
$version = _dbs()->getVersion('admin_menu');
// create table
if ($version < 1) {
    _dbs()->create('admin_menu')
        ->addVarchar('name', 255)
        ->addVarchar('admin_controller', 255)
        ->addInt('parent')
        ->addInt('status', 4)
        ->execute();
    _dbs()->commitVersion('admin_menu', 1);
    $version = 1;
}