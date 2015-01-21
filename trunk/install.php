<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
require_once 'config.php';
require_once 'include.php';

$sys = pzk_parse('system/full');

$app = $sys->getApp();

_dbs()->create('schema_version')
	->addVarchar('schema_table')
	->addInt('schema_version')
	->execute();

$files = glob('install/*.php');
foreach($files as $file) {
	require_once $file;
}