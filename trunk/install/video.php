<?php
// Set up table questions
echo 'Install video Table <br />';
$version = _dbs()->getVersion('video');
// create table
if ($version < 1) {
    _dbs()->create('video')
        ->addVarchar('url', 255)
        ->addVarchar('name', 255)
        ->addInt('category_id')
        ->addInt('status', 4)
        ->execute();
    _dbs()->commitVersion('video', 1);
    $version = 1;
}